<?php

declare(strict_types=1);

namespace PoPSchema\CustomPostMediaMutations\MutationResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;
use PoPSchema\CustomPostMediaMutationsWP\TypeAPIs\CustomPostMediaTypeAPI;

class RemoveFeaturedImageOnCustomPostMutationResolver extends AbstractMutationResolver
{
    /**
     * @return mixed
     */
    public function execute(array $form_data)
    {
        $customPostID = $form_data[MutationInputProperties::CUSTOMPOST_ID];
        $customPostMediaTypeAPI = CustomPostMediaTypeAPI::getInstance();
        $customPostMediaTypeAPI->removeFeaturedImage($customPostID);
        return $customPostID;
    }

    public function validateErrors(array $form_data): ?array
    {
        $errors = [];
        $translationAPI = TranslationAPIFacade::getInstance();
        if (!$form_data[MutationInputProperties::CUSTOMPOST_ID]) {
            $errors[] = $translationAPI->__('The custom post ID is missing.', 'custompostmedia-mutations');
        }
        return $errors;
    }
}
