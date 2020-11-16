<?php

declare(strict_types=1);

namespace PoPSchema\CustomPostMediaMutations\FieldResolvers;

use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\Translation\Facades\TranslationAPIFacade;
use PoPSchema\Media\TypeResolvers\MediaTypeResolver;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoPSchema\CustomPosts\TypeResolvers\CustomPostTypeResolver;
use PoP\ComponentModel\FieldResolvers\AbstractQueryableFieldResolver;
use PoPSchema\CustomPostMediaMutations\MutationResolvers\MutationInputProperties;
use PoPSchema\CustomPosts\FieldInterfaceResolvers\IsCustomPostFieldInterfaceResolver;
use PoPSchema\CustomPostMediaMutations\MutationResolvers\SetFeaturedImageOnCustomPostMutationResolver;
use PoPSchema\CustomPostMediaMutations\MutationResolvers\RemoveFeaturedImageOnCustomPostMutationResolver;

class CustomPostFieldResolver extends AbstractQueryableFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(IsCustomPostFieldInterfaceResolver::class);
    }

    public static function getFieldNamesToResolve(): array
    {
        return [
            'setFeaturedImage',
            'removeFeaturedImage',
        ];
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
            'setFeaturedImage' => $translationAPI->__('Set the featured image on the custom post', 'custompostmedia-mutations'),
            'removeFeaturedImage' => $translationAPI->__('Remove the featured image on the custom post', 'custompostmedia-mutations'),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }

    public function getSchemaFieldType(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $types = [
            'setFeaturedImage' => SchemaDefinition::TYPE_ID,
            'removeFeaturedImage' => SchemaDefinition::TYPE_ID,
        ];
        return $types[$fieldName] ?? parent::getSchemaFieldType($typeResolver, $fieldName);
    }

    public function isSchemaFieldResponseNonNullable(TypeResolverInterface $typeResolver, string $fieldName): bool
    {
        $nonNullableFieldNames = [
            'setFeaturedImage',
            'removeFeaturedImage',
        ];
        if (in_array($fieldName, $nonNullableFieldNames)) {
            return true;
        }
        return parent::isSchemaFieldResponseNonNullable($typeResolver, $fieldName);
    }

    public function getSchemaFieldArgs(TypeResolverInterface $typeResolver, string $fieldName): array
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        switch ($fieldName) {
            case 'setFeaturedImage':
                return [
                    [
                        SchemaDefinition::ARGNAME_NAME => MutationInputProperties::MEDIA_ITEM_ID,
                        SchemaDefinition::ARGNAME_TYPE => SchemaDefinition::TYPE_ID,
                        SchemaDefinition::ARGNAME_DESCRIPTION => sprintf(
                            $translationAPI->__('The ID of the featured image, of type \'%s\'', 'custompostmedia-mutations'),
                            MediaTypeResolver::NAME
                        ),
                        SchemaDefinition::ARGNAME_MANDATORY => true,
                    ],
                ];
        }
        return parent::getSchemaFieldArgs($typeResolver, $fieldName);
    }

    protected function getFieldArgsToExecuteMutation(
        array $fieldArgs,
        TypeResolverInterface $typeResolver,
        object $resultItem,
        string $fieldName,
        array $options = []
    ): array {
        $fieldArgs = parent::getFieldArgsToExecuteMutation(
            $fieldArgs,
            $typeResolver,
            $resultItem,
            $fieldName,
            $options
        );
        $post = $resultItem;
        switch ($fieldName) {
            case 'setFeaturedImage':
            case 'removeFeaturedImage':
                $fieldArgs[MutationInputProperties::CUSTOMPOST_ID] = $typeResolver->getID($post);
                break;
        }

        return $fieldArgs;
    }

    public function resolveFieldMutationResolverClass(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        switch ($fieldName) {
            case 'setFeaturedImage':
                return SetFeaturedImageOnCustomPostMutationResolver::class;
            case 'removeFeaturedImage':
                return RemoveFeaturedImageOnCustomPostMutationResolver::class;
        }

        return parent::resolveFieldMutationResolverClass($typeResolver, $fieldName);
    }

    public function resolveFieldTypeResolverClass(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        switch ($fieldName) {
            case 'setFeaturedImage':
            case 'removeFeaturedImage':
                return CustomPostTypeResolver::class;
        }

        return parent::resolveFieldTypeResolverClass($typeResolver, $fieldName);
    }
}
