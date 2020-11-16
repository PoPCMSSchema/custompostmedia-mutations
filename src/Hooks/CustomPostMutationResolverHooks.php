<?php

declare(strict_types=1);

namespace PoPSchema\CustomPostMediaMutations\Hooks;

use PoP\Hooks\AbstractHookSet;
use PoP\Translation\Facades\TranslationAPIFacade;

class CustomPostMutationResolverHooks extends AbstractHookSet
{
    protected function init()
    {
        $this->hooksAPI->addFilter(
            'GD_CreateUpdate_Post:form-data',
            array($this, 'getFormData'),
            10
        );
        $this->hooksAPI->addAction(
            'GD_CreateUpdate_Post:validatecontent',
            array($this, 'validatecontent'),
            10,
            2
        );
        $this->hooksAPI->addAction(
            'gd_createupdate_post',
            array($this, 'createupdate'),
            10,
            2
        );
    }

    public function validatecontent($errors_in_array, $form_data)
    {
        $errors = &$errors_in_array[0];

        // if ($link = $form_data['link']) {
        //     if (!isValidUrl($link)) {
        //         $errors[] = TranslationAPIFacade::getInstance()->__('The external link has an invalid format', 'pop-addpostlinks');
        //     }
        // }
    }

    public function createupdate($post_id, $form_data)
    {
        // // Save the link in the post meta
        // $link = $form_data['link'];
        // if ($link) {
        //     \PoPSchema\CustomPostMeta\Utils::updateCustomPostMeta($post_id, GD_METAKEY_POST_LINK, $link, true);
        // } else {
        //     \PoPSchema\CustomPostMeta\Utils::deleteCustomPostMeta($post_id, GD_METAKEY_POST_LINK);
        // }
    }

    public function getFormData($form_data)
    {
        // $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();

        // $form_data['link'] = $moduleprocessor_manager->getProcessor([PoP_AddPostLinks_Module_Processor_TextFormInputs::class, PoP_AddPostLinks_Module_Processor_TextFormInputs::MODULE_ADDPOSTLINKS_FORMINPUT_LINK])->getValue([PoP_AddPostLinks_Module_Processor_TextFormInputs::class, PoP_AddPostLinks_Module_Processor_TextFormInputs::MODULE_ADDPOSTLINKS_FORMINPUT_LINK]);

        return $form_data;
    }
}
