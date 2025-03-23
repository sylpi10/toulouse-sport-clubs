<?php
namespace App\Serializer;

use ReflectionMethod;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

//Création d'un Normalizer d'entité afin de pouvoir gerer la facon dont les relations sont transformés en JSON
// et pour eviter les references circulaires
class EntityNormalizer implements NormalizerInterface
{

    public function __construct($normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function normalize($object, string $format = null, array $context = []) : mixed
    {
        $reflectionObject = new \ReflectionObject($object);
        $reflectionMethods = $reflectionObject->getMethods(\ReflectionMethod::IS_PUBLIC);

        $data = array();
        foreach ($reflectionMethods as $method) {
            //If method start with get or is
            if ($this->isGetMethod($method) || $this->isIsMethod($method)) {
                $attributeName = $this->isGetMethod($method) ?
                    $this->camelCase2UnderScore(substr($method->name, 3)) :
                    $this->camelCase2UnderScore(substr($method->name, 2));
                //We call method to get the value
                $attributeValue = $method->invoke($object);
                //If value is a collection, we don't handle it to break circular call
                if ($attributeValue instanceof \Doctrine\ORM\PersistentCollection) {
                    continue;
                }
                if (is_object($attributeValue))
                {
                    //If object has a getId method, we propably handle an entity object, therefore we only ger the id to show the relation
                    if (method_exists($attributeValue, "getId") && $attributeValue->getId() !== null)
                    {
                        $attributeName .= "_id";
                        $attributeValue = $attributeValue->getId();
                    }
                    else
                        //else it's probably a PHP object (Datetime,...) so we normalize them
                        $attributeValue = $this->normalizer->normalize($attributeValue, $format);
                }


                $data[$attributeName] = $attributeValue;
            }
        }


        return $data;
    }

    /**
     * Checks if a method's name is get.* and can be called without parameters.
     *
     * @param ReflectionMethod $method the method to check
     * @return Boolean whether the method is a getter.
     */
    private function isGetMethod(\ReflectionMethod $method)
    {
        return (
            0 === strpos($method->name, 'get') &&
            3 < strlen($method->name) &&
            0 === $method->getNumberOfRequiredParameters()
        );
    }

    /**
     * Checks if a method's name is is.* and can be called without parameters.
     *
     * @param ReflectionMethod $method the method to check
     * @return Boolean whether the method is a getter.
     */
    private function isIsMethod(\ReflectionMethod $method)
    {
        return (
            0 === strpos($method->name, 'is') &&
            2 < strlen($method->name) &&
            0 === $method->getNumberOfRequiredParameters()
        );
    }

    /**
     * Convert Camel Case String to underscore-separated
     * @param string $str The input string.
     * @param string $separator Separator, the default is underscore
     * @return string
     */
    private function camelCase2UnderScore($str, $separator = "_")
    {
        if (empty($str)) {
            return $str;
        }
        $str = lcfirst($str);
        $str = preg_replace("/[A-Z]/", $separator . "$0", $str);
        return strtolower($str);
    }


    public function supportsNormalization($data, string $format = null, array $context = []) : bool
    {
        if (is_object($data))
        {
            $reflectionObject = new \ReflectionObject($data);
            $namespaceName = $reflectionObject->getNamespaceName();
            return $namespaceName === "App\Entity";
        }
        return false;

    }
}