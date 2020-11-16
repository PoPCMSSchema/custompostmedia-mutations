<?php

declare(strict_types=1);

namespace PoPSchema\CustomPostMediaMutations\MutationResolvers;

use PoP\ComponentModel\Error;
use PoP\Hooks\Facades\HooksAPIFacade;
use PoPSchema\CustomPosts\Types\Status;
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\LooseContracts\Facades\NameResolverFacade;
use PoPSchema\CustomPosts\Facades\CustomPostTypeAPIFacade;
use PoP\ComponentModel\Facades\Instances\InstanceManagerFacade;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;
use PoPSchema\CustomPostMutations\Facades\CustomPostTypeAPIFacade as MutationCustomPostTypeAPIFacade;

class RemoveFeaturedImageOnCustomPostMutationResolver extends AbstractMutationResolver
{
    /**
     * @return mixed
     */
    public function execute(array $form_data)
    {
        return $form_data[MutationInputProperties::CUSTOMPOST_ID];
        // return $this->update($form_data);
    }

    // protected function getCategoryTaxonomy(): ?string
    // {
    //     return null;
    // }

    // // Update Post Validation
    // protected function validatecontent(&$errors, $form_data)
    // {
    //     // Allow plugins to add validation for their fields
    //     HooksAPIFacade::getInstance()->doAction(
    //         'GD_CreateUpdate_Post:validatecontent',
    //         array(&$errors),
    //         $form_data
    //     );
    // }

    // protected function validatecreatecontent(&$errors, $form_data)
    // {
    // }
    // protected function validateupdatecontent(&$errors, $form_data)
    // {
    // }

    // // Update Post Validation
    // protected function validatecreate(&$errors)
    // {
    //     // Validate user permission
    //     $cmsuserrolesapi = \PoPSchema\UserRoles\FunctionAPIFactory::getInstance();
    //     if (!$cmsuserrolesapi->currentUserCan(NameResolverFacade::getInstance()->getName('popcms:capability:editPosts'))) {
    //         $errors[] = TranslationAPIFacade::getInstance()->__('Your user doesn\'t have permission for editing.', 'pop-application');
    //     }
    // }

    // /**
    //  * The ID comes directly as a parameter in the request, it's not a form field
    //  *
    //  * @return mixed
    //  */
    // protected function getUpdateCustomPostID()
    // {
    //     return $_REQUEST[POP_INPUTNAME_POSTID];
    // }

    // // Update Post Validation
    // protected function validateupdate(&$errors)
    // {
    //     $post_id = $this->getUpdateCustomPostID();

    //     // Validate there is postid
    //     if (!$post_id) {
    //         $errors[] = TranslationAPIFacade::getInstance()->__('Cheating, huh?', 'pop-application');
    //         return;
    //     }

    //     $customPostTypeAPI = CustomPostTypeAPIFacade::getInstance();
    //     $post = $customPostTypeAPI->getCustomPost($post_id);
    //     if (!$post) {
    //         $errors[] = TranslationAPIFacade::getInstance()->__('Cheating, huh?', 'pop-application');
    //         return;
    //     }

    //     $status = $customPostTypeAPI->getStatus($post_id);
    //     $instanceManager = InstanceManagerFacade::getInstance();
    //     /**
    //      * @var CustomPostStatusEnum
    //      */
    //     $customPostStatusEnum = $instanceManager->getInstance(CustomPostStatusEnum::class);
    //     if (!in_array($status, $customPostStatusEnum->getValues())) {
    //         $errors[] = sprintf(
    //             TranslationAPIFacade::getInstance()->__('Status \'%s\' is not supported', 'pop-application'),
    //             $status
    //         );
    //     }
    // }

    // /**
    //  * Function to override
    //  */
    // protected function additionals($post_id, $form_data)
    // {
    // }
    // /**
    //  * Function to override
    //  */
    // protected function updateadditionals($post_id, $form_data, $log)
    // {
    // }
    // /**
    //  * Function to override
    //  */
    // protected function createadditionals($post_id, $form_data)
    // {
    // }

    // // protected function addCustomPostType(&$post_data)
    // // {
    // //     $post_data['custompost-type'] = $this->getCustomPostType();
    // // }

    // protected function addCreateUpdateCustomPostData(array &$post_data, array $form_data)
    // {
    //     if (isset($form_data[MutationInputProperties::CONTENT])) {
    //         $post_data['content'] = $form_data[MutationInputProperties::CONTENT];
    //     }
    //     if (isset($form_data[MutationInputProperties::TITLE])) {
    //         $post_data['title'] = $form_data[MutationInputProperties::TITLE];
    //     }
    //     if (isset($form_data[MutationInputProperties::STATUS])) {
    //         $post_data['status'] = $form_data[MutationInputProperties::STATUS];
    //     }
    // }

    // protected function getUpdateCustomPostData($form_data)
    // {
    //     $post_data = array(
    //         'id' => $form_data[MutationInputProperties::ID],
    //     );
    //     $this->addCreateUpdateCustomPostData($post_data, $form_data);

    //     return $post_data;
    // }

    // protected function getCreateCustomPostData($form_data)
    // {
    //     $post_data = [
    //         'custompost-type' => $this->getCustomPostType(),
    //     ];
    //     $this->addCreateUpdateCustomPostData($post_data, $form_data);

    //     // $this->addCustomPostType($post_data);

    //     return $post_data;
    // }

    // /**
    //  * @param array<string, mixed> $data
    //  * @return mixed the ID of the updated custom post
    //  */
    // protected function executeUpdateCustomPost(array $data)
    // {
    //     $customPostTypeAPI = MutationCustomPostTypeAPIFacade::getInstance();
    //     return $customPostTypeAPI->updateCustomPost($data);
    // }

    // protected function getCategories(array $form_data): ?array
    // {
    //     return $form_data[MutationInputProperties::CATEGORIES];
    // }

    // protected function createUpdateCustomPost($form_data, $post_id)
    // {
    //     // Set category taxonomy for taxonomies other than "category"
    //     $taxonomyapi = \PoPSchema\Taxonomies\FunctionAPIFactory::getInstance();
    //     $taxonomy = $this->getCategoryTaxonomy();
    //     if ($cats = $this->getCategories($form_data)) {
    //         $taxonomyapi->setPostTerms($post_id, $cats, $taxonomy);
    //     }

    //     $this->setfeaturedimage($post_id, $form_data);
    // }

    // protected function getUpdateCustomPostDataLog($post_id, $form_data)
    // {
    //     $customPostTypeAPI = CustomPostTypeAPIFacade::getInstance();
    //     $log = array(
    //         'previous-status' => $customPostTypeAPI->getStatus($post_id),
    //     );

    //     return $log;
    // }

    // protected function update(array $form_data)
    // {
    //     $post_data = $this->getUpdateCustomPostData($form_data);
    //     $post_id = $post_data['id'];

    //     // Create the operation log, to see what changed. Needed for
    //     // - Send email only when post published
    //     // - Add user notification of post being referenced, only when the reference is new (otherwise it will add the notification each time the user updates the post)
    //     $log = $this->getUpdateCustomPostDataLog($post_id, $form_data);

    //     $result = $this->executeUpdateCustomPost($post_data);

    //     if ($result === 0) {
    //         return new Error(
    //             'update-error',
    //             TranslationAPIFacade::getInstance()->__('Oops, there was a problem... this is embarrassing, huh?', 'pop-application')
    //         );
    //     }

    //     $this->createUpdateCustomPost($form_data, $post_id);

    //     // Allow for additional operations (eg: set Action categories)
    //     $this->additionals($post_id, $form_data);
    //     $this->updateadditionals($post_id, $form_data, $log);

    //     // Inject Share profiles here
    //     HooksAPIFacade::getInstance()->doAction('gd_createupdate_post', $post_id, $form_data);
    //     HooksAPIFacade::getInstance()->doAction('gd_createupdate_post:update', $post_id, $log, $form_data);
    //     return $post_id;
    // }

    // /**
    //  * @param array<string, mixed> $data
    //  * @return mixed the ID of the created custom post
    //  */
    // protected function executeCreateCustomPost(array $data)
    // {
    //     $customPostTypeAPI = MutationCustomPostTypeAPIFacade::getInstance();
    //     return $customPostTypeAPI->createCustomPost($data);
    // }

    // protected function create(array $form_data)
    // {
    //     $post_data = $this->getCreateCustomPostData($form_data);
    //     $post_id = $this->executeCreateCustomPost($post_data);

    //     if ($post_id == 0) {
    //         return new Error(
    //             'create-error',
    //             TranslationAPIFacade::getInstance()->__('Oops, there was a problem... this is embarrassing, huh?', 'pop-application')
    //         );
    //     }

    //     $this->createUpdateCustomPost($form_data, $post_id);

    //     // Allow for additional operations (eg: set Action categories)
    //     $this->additionals($post_id, $form_data);
    //     $this->createadditionals($post_id, $form_data);

    //     // Inject Share profiles here
    //     HooksAPIFacade::getInstance()->doAction('gd_createupdate_post', $post_id, $form_data);
    //     HooksAPIFacade::getInstance()->doAction('gd_createupdate_post:create', $post_id, $form_data);

    //     return $post_id;
    // }

    // protected function setfeaturedimage($post_id, $form_data)
    // {
    //     if (isset($form_data[MutationInputProperties::FEATUREDIMAGE])) {
    //         $featuredimage = $form_data[MutationInputProperties::FEATUREDIMAGE];

    //         // Featured Image
    //         if ($featuredimage) {
    //             \set_post_thumbnail($post_id, $featuredimage);
    //         } else {
    //             \delete_post_thumbnail($post_id);
    //         }
    //     }
    // }
}
