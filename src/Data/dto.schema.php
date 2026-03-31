<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Klkvsk\DtoGenerator\Schema as dto;
use Klkvsk\DtoGenerator\Schema\Types as t;

return dto\schema(
    namespace: 'BeelineOrd\\Data',
    objects: [
        // USER:
        dto\object(
            name: 'User\\UserViewModel',
            fields: [
                dto\field('id', t\int()),
                dto\field('organizationId', t\int()),
                dto\field('username', t\string()),
                dto\field('inn', t\string()),
                dto\field('email', t\string()),
                dto\field('role', t\string()),
                dto\field('permissions', t\list_(t\string())),
            ]
        ),

        // PLATFORM:
        dto\enum(
            name: 'Platform\\PlatformType',
            cases: [ 'Site', 'Application', 'InformationSystem' ]
        ),
        dto\object(
            name: 'Platform\\PlatformEditModel',
            fields: [
                dto\field('name', t\string(), true),
                dto\field('url', t\string(), true),
                dto\field('isOwned', t\bool(), true),
                dto\field('type', t\enum('Platform\\PlatformType'), true),
            ]
        ),
        dto\object(
            name: 'Platform\\PlatformCreateModel',
            extends: 'Platform\\PlatformEditModel',
            fields: [
                dto\field('organizationId', t\int()),
            ]
        ),
        dto\object(
            name: 'Platform\\PlatformViewModel',
            extends: 'Platform\\PlatformCreateModel',
            fields: [
                dto\field('id', t\int(), true),

                // not in doc, but in api response:
                dto\field('erirExportedOn', t\date()),
                dto\field('erirPlannedExportDate', t\date()),
                dto\field('isEditable', t\bool()),
            ]
        ),
        // ---

        // CONTRACT:
        dto\enum(
            name: 'Contract\\ContractType',
            cases: ['Intermediary', 'Original', 'Additional', 'SelfPromotion']
        ),
        dto\enum(
            name: 'Contract\\ContractActionType',
            cases: ['Other', 'Distribution', 'Conclude', 'Commercial', 'None']
        ),
        dto\enum(
            name: 'Contract\\ContractOrganizationType',
            cases: [
                'PhysicalPerson', 'LegalPerson', 'IndividualEntrepreneur', 'ForeignPhysicalPerson', 'ForeignLegalPerson'
            ]
        ),
        dto\object(
            name: 'Contract\\InitialContract',
            fields: [
                dto\field('id', t\int(), true),
                dto\field('number', t\string()),
                dto\field('date', t\date()),
            ]
        ),
        dto\object(
            name: 'Contract\\ContractModel',
            fields: [
                dto\field('type', t\enum('Contract\\ContractType'), true),
                dto\field('executorIsObligedForRegistration', t\bool(), true),
                dto\field('actionType', t\enum('Contract\\ContractActionType'), true),
                dto\field('subjectType', t\string(), true),
                dto\field('number', t\string(), true),
                dto\field('date', t\date(), true),
                dto\field('amount', t\float()),
                dto\field('isVat', t\bool()),
                dto\field('parentContractId', t\int()),
                dto\field('customerId', t\int()),
                dto\field('executorId', t\int()),
                dto\field('isInitialContract', t\bool()),
                dto\field('customerInn', t\string()),
                dto\field('customerName', t\string()),
                dto\field('customerType', t\enum('Contract\\ContractOrganizationType')),
                dto\field('executorInn', t\string()),
                dto\field('executorName', t\string()),
                dto\field('executorType', t\enum('Contract\\ContractOrganizationType')),
            ]
        ),
        dto\object(
            name: 'Contract\\ContractEditModel',
            extends: 'Contract\\ContractModel',
            fields: [
                dto\field('isReadyForErir', t\bool(), true),
            ]
        ),
        dto\object(
            name: 'Contract\\ContractCreateModel',
            extends: 'Contract\\ContractEditModel',
            fields: [
                dto\field('parentContractId', t\int()),
            ]
        ),
        dto\object(
            name: 'Contract\\ContractViewModel',
            extends: 'Contract\\ContractModel',
            fields: [
                dto\field('id', t\int(), true),
                dto\field('parentContractId', t\int()),

                dto\field('erirExportedOn', t\date()),
                dto\field('erirPlannedExportDate', t\date()),
                dto\field('erirExportedStatus', t\int()),
                dto\field('exportError', t\bool()),
            ]
        ),
        // ---

        // CREATIVE
        dto\enum('Creative\\CreativeType', [
            'Other', 'PayForViews', 'PayForClicks', 'PayForActions',
        ]),
        dto\enum('Creative\\CreativeForm', [
            'TextGraphicBlock', 'TextBlock', 'Video', 'LiveVideo', 'LiveAudio', 'Banner', 'AudioRecord', 'TextVideoBlock',
            'TextGraphicVideoBlock', 'TextAudioBlock', 'TextGraphicAudioBlock', 'TextAudioVideoBlock', 'TextGraphicAudioVideoBlock',
            'BannerHtml5',
        ]),

        dto\object(
            name: 'Creative\\CreativeImportResult',
            fields: [
                dto\field('ids', t\list_(t\int())),
            ]
        ),
        dto\object(
            name: 'Creative\\CreativeUrl',
            fields: [
                dto\field('url', t\string(), true),
            ]
        ),

        dto\object(
            name: 'Creative\\CreativeEditModel',
            fields: [
                dto\field('type', t\enum('Creative\\CreativeType'), true),
                dto\field('form', t\enum('Creative\\CreativeForm'), true),
                dto\field('description', t\string(), true),
                dto\field('isSocial', t\bool(), true),
                dto\field('isNative', t\bool(), true),
                dto\field('urls', t\list_(t\object('Creative\\CreativeUrl')), true),
                dto\field('okveds', t\list_(t\string())),
                dto\field('kktuCode', t\list_(t\string())),
                dto\field('targetAudienceDescription', t\string()),
                dto\field('isReadyForErir', t\bool(), true),
                dto\field('initialContractId', t\int(), true),
            ]
        ),
        dto\object(
            name: 'Creative\\CreativeCreateModel',
            extends: 'Creative\\CreativeEditModel',
            fields: [
                dto\field('organizationId', t\int(), false),
            ]
        ),
        dto\object(
            name: 'Creative\\CreativeListModel',
            fields: [
                dto\field('id', t\int(), true),
                dto\field('description', t\string(), true),
                dto\field('erid', t\string()),
                dto\field('erirExportedOn', t\date()),
                dto\field('erirPlannedExportDate', t\date()),
                dto\field('erirExportedStatus', t\int()),
                dto\field('exportError', t\string()),
                dto\field('selfPromotionOrganizationId', t\int()),
                dto\field('isTelegram', t\bool()),
            ]
        ),
        dto\object(
            name: 'Creative\\CreativeViewModel',
            extends: 'Creative\\CreativeListModel',
            fields: [
                dto\field('type', t\enum('Creative\\CreativeType'), true),
                dto\field('form', t\enum('Creative\\CreativeForm'), true),
                dto\field('description', t\string(), true),
                dto\field('isSocial', t\bool(), true),
                dto\field('isNative', t\bool(), true),
                dto\field('urls', t\list_(t\object('Creative\\CreativeUrl')), true),
                dto\field('okveds', t\list_(t\string())),
                dto\field('kktuCode', t\list_(t\string())),
                dto\field('targetAudienceDescription', t\string()),
                dto\field('initialContractId', t\int(), true),
                dto\field('organizationId', t\int()),
            ]
        ),
        // ---

        // CREATIVE CONTENT:
        dto\object(
            name: 'CreativeContent\\CreativeContentEditModel',
            fields: [
                dto\field('textData', t\string()),
                dto\field('hash', t\string(), validators: [
                    function () {
                        /**
                         * @var $this \BeelineOrd\Data\CreativeContent\CreativeContentEditModel
                         * @psalm-suppress InvalidScope
                         */
                        if ($this->textData !== null && $this->hash === null) {
                            $this->hash = hash('sha256', $this->textData);
                        }
                    },
                ]),
            ]
        ),
        dto\object(
            name: 'CreativeContent\\CreativeContentCreateModel',
            extends: 'CreativeContent\\CreativeContentEditModel',
            fields: [
                dto\field('creativeId', t\int(), true),
            ]
        ),
        dto\object(
            name: 'CreativeContent\\CreativeContentViewModel',
            extends: 'CreativeContent\\CreativeContentCreateModel',
            fields: [
                dto\field('id', t\int(), true),
                dto\field('description', t\string()),
                dto\field('mediaExampleUrl', t\string()),
            ]
        ),
        dto\object(
            name: 'CreativeContent\\CreativeContentUploadResultFileError',
            fields: [
                dto\field('fileName', t\string()),
                dto\field('error', t\string()),
            ]
        ),
        dto\object(
            name: 'CreativeContent\\CreativeContentUploadResult',
            fields: [
                dto\field('erid', t\string()),
                dto\field('filesCount', t\int()),
                dto\field('uploadedFilesCount', t\int()),
                dto\field('fileErrors', t\list_(t\object('CreativeContent\\CreativeContentUploadResultFileError'))),
            ]
        ),
        dto\object(
            name: 'CreativeContent\\CreativeContentImportResultErid',
            fields: [
                dto\field('creativeId', t\int()),
                dto\field('erid', t\string()),
            ]
        ),
        dto\object(
            name: 'CreativeContent\\CreativeContentImportResult',
            fields: [
                dto\field('erids', t\list_(t\object('CreativeContent\\CreativeContentImportResultErid'))),
                dto\field('ids', t\list_(t\int())),
            ]
        ),
        // ---

        // INVOICE:
        dto\enum(
            name: 'Invoice\\InvoiceType',
            cases: [ 'Statistics', 'Manual' ]
        ),
        dto\enum(
            name: 'Invoice\\InvoiceOrganizationRole',
            cases: ['AdvertisingAgency', 'AdvertisingDistributor', 'AdvertisingSystemOperator', 'Advertiser' ]
        ),
        dto\object(
            name: 'Invoice\\InvoiceEditModel',
            fields: [
                dto\field('number', t\string()),
                dto\field('date', t\date(), true),
                dto\field('startDate', t\date(), true),
                dto\field('endDate', t\date(), true),
                dto\field('amount', t\float(), true),
                dto\field('isVat', t\bool()),
                dto\field('customerRole', t\enum('Invoice\\InvoiceOrganizationRole'), true),
                dto\field('executorRole', t\enum('Invoice\\InvoiceOrganizationRole'), true),
                dto\field('isReadyForErir', t\bool(), true),
            ]
        ),
        dto\object(
            name: 'Invoice\\InvoiceCreateModel',
            extends: 'Invoice\\InvoiceEditModel',
            fields: [
                dto\field('contractId', t\int(), true),
                dto\field('type', t\enum('Invoice\\InvoiceType'), true),
            ]
        ),
        dto\object(
            name: 'Invoice\\InvoiceViewModel',
            extends: 'Invoice\\InvoiceCreateModel',
            fields: [
                dto\field('erirExportedOn', t\date()),
                dto\field('erirPlannedExportDate', t\date()),
            ]
        ),
        // ---

        // INVOICE ITEM:
        dto\object(
            name: 'InvoiceItem\\InvoiceItemEditModel',
            fields: [
                dto\field('name', t\string()),
                dto\field('amount', t\float(), true),
                dto\field('isVat', t\bool()),
                dto\field('initialContractId', t\int(), true),
            ]
        ),
        dto\object(
            name: 'InvoiceItem\\InvoiceItemCreateModel',
            extends: 'InvoiceItem\\InvoiceItemEditModel',
            fields: [
                dto\field('invoiceId', t\int(), true),
            ]
        ),
        dto\object(
            name: 'InvoiceItem\\InvoiceItemViewModel',
            extends: 'InvoiceItem\\InvoiceItemCreateModel',
            fields: [
                dto\field('id', t\int(), true),
            ]
        ),
        // ---

        // INVOICE ITEM STATISTICS
        dto\object(
            name: 'InvoiceItemStatistics\\InvoiceItemStatisticsEditModel',
            fields: [
                dto\field('actualImpressionsCount', t\int(), true),
                dto\field('plannedImpressionsCount', t\int(), true),
                dto\field('plannedStartDate', t\date(), true),
                dto\field('plannedEndDate', t\date(), true),
                dto\field('actualStartDate', t\date(), true),
                dto\field('actualEndDate', t\date(), true),
                dto\field('totalAmount', t\float(), true),
                dto\field('amountPerShow', t\float(), true),
                dto\field('isVat', t\bool()),
            ]
        ),
        dto\object(
            name: 'InvoiceItemStatistics\\InvoiceItemStatisticsCreateModel',
            extends: 'InvoiceItemStatistics\\InvoiceItemStatisticsEditModel',
            fields: [
                dto\field('invoiceItemId', t\int(), true),
                dto\field('creativeId', t\int(), true),
                dto\field('platformId', t\int(), true),
            ]
        ),
        dto\object(
            name: 'InvoiceItemStatistics\\InvoiceItemStatisticsViewModel',
            extends: 'InvoiceItemStatistics\\InvoiceItemStatisticsCreateModel',
        ),


        // FOREIGN ORGANIZATIONS
        dto\enum(
            name: 'OrganizationRef\\OrganizationRefType',
            cases: [ 'ForeignPhysicalPerson', 'ForeignLegalPerson' ]
        ),
        dto\object(
            name: 'OrganizationRef\\OrganizationRefCreateModel',
            fields: [
                dto\field('name', t\string(), required: true),
                dto\field('okmsNumber', t\string(), required: true),
                dto\field('type', t\enum('OrganizationRef\\OrganizationRefType'), required: true),
                dto\field('mobilePhone', t\string()),
                dto\field('epayNumber', t\string()),
                dto\field('regNumber', t\string()),
                dto\field('alternativeInn', t\string()),
            ]
        ),
        dto\object(
            name: 'OrganizationRef\\OrganizationRefViewModel',
            extends: 'OrganizationRef\\OrganizationRefCreateModel',
            fields: [
                dto\field('id', t\int(), required: true),
            ]
        ),
        // ---
    ]
);
