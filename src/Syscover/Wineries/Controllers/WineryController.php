<?php namespace Syscover\Wineries\Controllers;

use Syscover\Pulsar\Core\Controller;
use Illuminate\Support\Facades\Hash;
use Syscover\Hotels\Models\Hotel;
use Syscover\Pulsar\Libraries\AttachmentLibrary;
use Syscover\Pulsar\Libraries\CustomFieldResultLibrary;
use Syscover\Pulsar\Models\AttachmentFamily;
use Syscover\Pulsar\Models\CustomFieldGroup;
use Syscover\Wineries\Models\Winery;
use Syscover\Wineries\Models\WineryLang;

/**
 * Class WineryController
 * @package Syscover\Wineries\Controllers
 */

class WineryController extends Controller
{
    protected $routeSuffix  = 'winery';
    protected $folder       = 'winery';
    protected $package      = 'wineries';
    protected $indexColumns = ['id_190', 'name_001', 'name_002', 'name_003', 'name_190', ['data' => 'active_190', 'type' => 'active']];
    protected $nameM        = 'name_190';
    protected $model        = Winery::class;
    protected $langModel    = WineryLang::class;
    protected $icon         = 'fa fa-glass';
    protected $objectTrans  = 'winery';

    public function customIndex($parameters)
    {
        $parameters['urlParameters']['lang'] = base_lang2()->id_001;
        // init record on tap 4
        $parameters['urlParameters']['tab']  = 2;

        return $parameters;
    }

    public function customActionUrlParameters($actionUrlParameters, $parameters)
    {
        $actionUrlParameters['tab'] = 2;

        return $actionUrlParameters;
    }

    public function createCustomRecord($parameters)
    {
        $parameters['attachmentFamilies']   = AttachmentFamily::getAttachmentFamilies(['resource_id_015' => 'wineries-winery']);
        $parameters['customFieldGroups']    = CustomFieldGroup::where('resource_id_025', 'wineries-winery')->get();
        $parameters['attachmentsInput']     = json_encode([]);
        $parameters['hotels']               = Hotel::builder()->where('active_170', true)->get();

        if(isset($parameters['id']))
        {
            // get attachments from base lang
            $attachments = AttachmentLibrary::getRecords($this->package, 'wineries-winery', $parameters['id'], base_lang2()->id_001, true);

            // merge parameters and attachments array
            $parameters  = array_merge($parameters, $attachments);
        }

        return $parameters;
    }

    public function checkSpecialRulesToStore($parameters)
    {
        if(isset($parameters['id']))
        {
            $winery = Winery::find($parameters['id']);

            $parameters['specialRules']['emailRule']    = $this->request->input('email') == $winery->email_190? true : false;
        }

        return $parameters;
    }

    public function storeCustomRecord($parameters)
    {
        if(!$this->request->has('id'))
        {
            // create new winery
            $winery = Winery::create([
                'field_group_id_190'                        => $this->request->has('customFieldGroup')? $this->request->input('customFieldGroup') : null,
                'hotel_id_190'                                  => $this->request->has('hotel')? $this->request->input('hotel') : null,
                'name_190'                                      => $this->request->input('name'),
                'slug_190'                                      => $this->request->input('slug'),
                'web_190'                                       => $this->request->input('web'),
                'web_url_190'                                   => $this->request->input('webUrl'),
                'contact_190'                                   => $this->request->input('contact'),
                'email_190'                                     => $this->request->input('email'),
                'phone_190'                                     => $this->request->input('phone'),
                'mobile_190'                                    => $this->request->input('mobile'),
                'fax_190'                                       => $this->request->input('fax'),
                'active_190'                                    => $this->request->has('active'),
                'country_id_190'                                => $this->request->input('country'),
                'territorial_area_1_id_190'                     => $this->request->has('territorialArea1') ? $this->request->input('territorialArea1') : null,
                'territorial_area_2_id_190'                     => $this->request->has('territorialArea2') ? $this->request->input('territorialArea2') : null,
                'territorial_area_3_id_190'                     => $this->request->has('territorialArea3') ? $this->request->input('territorialArea3') : null,
                'cp_190'                                        => $this->request->input('cp'),
                'locality_190'                                  => $this->request->input('locality'),
                'address_190'                                   => $this->request->input('address'),
                'latitude_190'                                  => str_replace(',', '', $this->request->input('latitude')),   // replace ',' character, can contain this character that damage script
                'longitude_190'                                 => str_replace(',', '', $this->request->input('longitude')),  // replace ',' character, can contain this character that damage script
                'booking_data_190'                              => $this->request->input('bookingData'),
                'booking_email_190'                             => $this->request->input('bookingEmail'),
            ]);

            $id     = $winery->id_190;
            $idLang = null;
        }
        else
        {
            // create winery language
            $id     = $this->request->input('id');
            $idLang = $id;
        }

        Winery::where('id_190', $id)->update([
            'data_lang_190'                 => Winery::addLangDataRecord($this->request->input('lang'), $idLang)
        ]);

        WineryLang::create([
            'id_191'                        => $id,
            'lang_id_191'                   => $this->request->input('lang'),
            'description_title_191'         => $this->request->has('descriptionTitle')? $this->request->input('descriptionTitle') : null,
            'description_191'               => $this->request->has('description')? $this->request->input('description') : null,
            'activity_191'                  => $this->request->has('activity')? $this->request->input('activity') : null,
        ]);

        // set attachments
        $attachments = json_decode($this->request->input('attachments'));
        AttachmentLibrary::storeAttachments($attachments, $this->package, 'wineries-winery', $id, $this->request->input('lang'));

        // set custom fields
        if(!empty($this->request->input('customFieldGroup')))
            CustomFieldResultLibrary::storeCustomFieldResults($this->request, $this->request->input('customFieldGroup'), 'wineries-winery', $id, $this->request->input('lang'));
    }

    public function editCustomRecord($parameters)
    {
        // get attachments elements
        $attachments = AttachmentLibrary::getRecords('wineries', 'wineries-winery', $parameters['object']->id_190, $parameters['lang']->id_001);

        // merge parameters and attachments array
        $parameters['attachmentFamilies']   = AttachmentFamily::getAttachmentFamilies(['resource_id_015' => 'wineries-winery']);
        $parameters['customFieldGroups']    = CustomFieldGroup::builder()->where('resource_id_025', 'wineries-winery')->get();
        $parameters['hotels']               = Hotel::builder()->where('active_170', true)->get();

        $parameters                         = array_merge($parameters, $attachments);

        return $parameters;
    }

    public function checkSpecialRulesToUpdate($parameters)
    {
        $winery = Winery::find($parameters['id']);

        $parameters['specialRules']['emailRule']    = $this->request->input('email') == $winery->email_190? true : false;

        return $parameters;
    }

    public function updateCustomRecord($parameters)
    {
        $winery = [
            'field_group_id_190'                            => $this->request->has('customFieldGroup')? $this->request->input('customFieldGroup') : null,
            'hotel_id_190'                                  => $this->request->has('hotel')? $this->request->input('hotel') : null,
            'name_190'                                      => $this->request->input('name'),
            'slug_190'                                      => $this->request->input('slug'),
            'web_190'                                       => $this->request->input('web'),
            'web_url_190'                                   => $this->request->input('webUrl'),
            'contact_190'                                   => $this->request->input('contact'),
            'email_190'                                     => $this->request->input('email'),
            'phone_190'                                     => $this->request->input('phone'),
            'mobile_190'                                    => $this->request->input('mobile'),
            'fax_190'                                       => $this->request->input('fax'),
            'active_190'                                    => $this->request->has('active'),
            'country_id_190'                                => $this->request->input('country'),
            'territorial_area_1_id_190'                     => $this->request->has('territorialArea1') ? $this->request->input('territorialArea1') : null,
            'territorial_area_2_id_190'                     => $this->request->has('territorialArea2') ? $this->request->input('territorialArea2') : null,
            'territorial_area_3_id_190'                     => $this->request->has('territorialArea3') ? $this->request->input('territorialArea3') : null,
            'cp_190'                                        => $this->request->input('cp'),
            'locality_190'                                  => $this->request->input('locality'),
            'address_190'                                   => $this->request->input('address'),
            'latitude_190'                                  => str_replace(',', '', $this->request->input('latitude')),   // replace ',' character, can contain this character that damage script
            'longitude_190'                                 => str_replace(',', '', $this->request->input('longitude')),  // replace ',' character, can contain this character that damage script)
            'booking_data_190'                              => $this->request->input('bookingData'),
            'booking_email_190'                             => $this->request->input('bookingEmail'),
        ];

        if($parameters['specialRules']['emailRule'])  $hotel['email_190']       = $this->request->input('email');

        Winery::where('id_190', $parameters['id'])->update($winery);

        // por si hiciera falta a futuro, sinconizar el winery con otros elementos,
        // haría falta el objedo actualizado
        //$winery = Winery::find($parameters['id']);

        WineryLang::where('id_191', $parameters['id'])->where('lang_id_191', $this->request->input('lang'))->update([
            'description_title_191'         => $this->request->has('descriptionTitle')? $this->request->input('descriptionTitle') : null,
            'description_191'               => $this->request->has('description')? $this->request->input('description') : null,
            'activity_191'                  => $this->request->has('activity')? $this->request->input('activity') : null,
        ]);

        // set custom fields
        if(!empty($this->request->input('customFieldGroup')))
        {
            CustomFieldResultLibrary::deleteCustomFieldResults('wineries-winery', $parameters['id'], $this->request->input('lang'));
            CustomFieldResultLibrary::storeCustomFieldResults($this->request, $this->request->input('customFieldGroup'), 'wineries-winery', $parameters['id'], $this->request->input('lang'));
        }
    }

    public function deleteCustomRecord($object)
    {
        // delete all attachments
        AttachmentLibrary::deleteAttachment($this->package, 'wineries-winery', $object->id_190);
    }

    public function deleteCustomTranslationRecord($object)
    {
        // delete all attachments from lang object
        AttachmentLibrary::deleteAttachment($this->package, 'wineries-winery', $object->id_191, $object->lang_id_191);
    }

    public function deleteCustomRecordsSelect($ids)
    {
        foreach($ids as $id)
        {
            AttachmentLibrary::deleteAttachment($this->package, 'wineries-winery', $id);
        }
    }

    public function apiCheckSlug()
    {
        return response()->json([
            'status'    => 'success',
            'slug'      => Winery::checkSlug('slug_190', $this->request->input('slug'), $this->request->input('id'))
        ]);
    }
}