<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefsA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $refs = [
            'list_boolean',
            'list_bank_account_type',
            'list_bank',
            'list_uf',
            'list_city',
            'list_genre',
            'list_identity_type_pvd',
            'list_month',
            'list_phone_cod',
            'list_phone_ddd',
            'list_street_country',
            'list_street_state',
            'list_week_day',
            'ref_bank_account_type',
            'ref_contract_cus_type',
            'ref_contract_pvd_scale_type',
            'ref_contract_pvd_type',
            'ref_customer_status',
            'ref_customer_type',
            'ref_customersys_status',
            'ref_customersys_type',
            'ref_doc_type_csys',
            'ref_doc_type_cus',
            'ref_doc_type_pat',
            'ref_doc_type_pvd',
            'ref_file_type',
            'ref_file_mime_type',
            'ref_identity_type_pvd',
            'ref_invoice_pay_option',
            'list_month_day',
            'ref_order_item_status',
            'ref_order_item_type',
            'ref_order_status',
            'ref_order_type',
            'ref_payment_pvd_option',
            'ref_provider_type',
            'ref_provider_specialty',
            'ref_report_status',
            'ref_report_type',
            'ref_service_type',
            'ref_template_field_type',
            'ref_user_role_csys',
            'ref_user_status',
            'ref_user_type',
        ];

        foreach ($refs as $ref)
        {
            Schema::create($ref, function (Blueprint $table) use ($ref) {
                $table->id();
                $table->string('ref_slug');
                $table->string('ref_description');
                $table->string('ref_placeholder')->nullable();
                $table->string('ref_options')->nullable();
                $table->boolean('ref_to_view')->default(true);
                $table->string('ref_icon')->nullable()->default('activity');
                $table->string('ref_color')->nullable()->default('thmeme-1');
                $table->string('ref_color_bg')->nullable()->default('gray-100');
                //
                $table->bigInteger('customer_sys_id')->nullable()->unsigned();
                $table->foreign('customer_sys_id')->references('id')->on('tb_customersys');
                //
                $table->timestamps();
                $table->softDeletes();
                //
                $table->unique(['customer_sys_id','ref_slug'], "uq_{$ref}_customersys_slug");
            });
        }
    }
}
