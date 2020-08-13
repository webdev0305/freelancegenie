<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public static $register = array(
        'first_name' => 'required|min:2|max:32',
        'last_name' => 'required|min:2|max:32',
        'email' => 'required|email|max:255',
        'password' => 'required|min:6',
        'password_confirmation' => 'required|same:password|min:6',
    );
    public static $login = array(
        'email' => 'required|email|max:255',
        'password' => 'required|min:6',
    );

    public static $forgot_email = array(
        'email' => 'required|string|email|max:255',
    );

    public static $pass_reset = array(
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
    );

    public static $change_pass = array(
        'old_password' => 'required|min:6',
        'password' => 'required|min:6',
        'confirm_password' => 'required|same:password|min:6',
    );

    public static $contct = array(
        'name' => 'required|min:2|max:255',
        'email' => 'required|email',
        'subject' => 'required|min:2|max:255',
        'body' => 'required|min:2|max:50000',
    );
    public static $enquiry = array(
        'name' => 'required|min:2|max:255',
        'email' => 'required|email',
        'body' => 'required|min:2|max:50000',
    );

    public static $userValid = array(
        'first_name' => 'required|min:2|max:32',
        'last_name' => 'required|min:2|max:32',
        'phone' => 'required',
        'photo' => 'mimes:jpeg,png,jpg,gif,svg|max:5000',
        'city' => 'required|min:2|max:255',
        //'street_name' => 'required|min:2|max:255',
        'country' => 'required',
        'address' => 'min:1|max:5000',
        //'zip' => 'required|regex:/[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}/i',
		'zip' => 'required',
        'about ' => 'min:2|max:5000',
        'certification_id ' => 'min:2|max:255',
        'cv' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:5000',
        'dbs_cert_upload' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:5000',
        'teaching_qual' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:5000',
        'teaching_cert' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:5000',
        'passport' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:5000',
        'work_permit' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:5000',
        'birth_certificate' => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:5000',
        //'pass_start_date' => 'required',
//    'pass_expiry_date' => 'required',
        //'passport_no' => 'required|min:2|max:255',
        //'permit_start_date' => 'required',
        //'permit_expiry_date' => 'required',
        //'permit_no' => 'required|min:2|max:255',
        'account_no' => 'required',
        're_account_no' => 'required|same:account_no',
        'bank_code' => 'required',
        're_bank_code' => 'required|same:bank_code',
    );

    public static $EmpValid = array(
        'first_name' => 'required|min:2|max:32',
        'last_name' => 'required|min:2|max:32',
        'company_name' => 'required|min:2|max:255',
        'company_address' => 'required|min:1|max:10',
        'contact_tel' => 'required',
        'head_office_address' => 'required|min:2|max:500',
        'authorised_user' => 'nullable|min:2|max:255',
        'authorised_user_second' => 'nullable|min:2|max:255',
        'head_office_contact_person' => 'required|min:2|max:300',
       'dept' => 'nullable|min:2|max:300',
       'company_logo' => 'mimes:jpeg,png,jpg,gif,svg|max:5000',
        'city' => 'nullable|min:2|max:255',
        'state' => 'nullable|min:2|max:255',

        'address' => 'nullable|min:1|max:5000',
        'zip' => 'nullable|regex:/[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}/i',
        'company_vat_reg_no' => 'required|min:2|max:255',
        'company_reg_no' => 'required|min:2|max:255',
        'photo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5000',
        //'report_name' => 'nullable|min:2|max:255',
        //'report_department' => 'nullable|min:2|max:255',
        'dept' => 'nullable|min:2|max:32',
        'additional_information' => 'nullable|min:2|max:255',
        'additional_details' => 'nullable|min:2|max:255',

    );

    public static $lang = array(
        'nameLang' => 'required|min:2|max:255',
    );

    public static $cate = array(
        'nameCat' => 'required|min:2|max:255',
    );

    public static $jobPost = array(
        //'title' => 'required|min:2|max:255',
		'booking_address' => 'required',
		'date' => 'required',
        'specialist' => 'required',
        'qualified_levels' => 'required',
        'type_levels' => 'required',
        'description' => 'nullable|min:2|max:3000',
		'fifty' => 'required',
		'file' => 'nullable|mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:5000',
     );
	 public static $carejobPost = array(
        'title' => 'required|min:2|max:255',
        'date' => 'required',
        'description' => 'nullable|min:2|max:3000',
		'file' => 'nullable|mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:5000',
     );
     public static $assignmentPost = array(
        'title' => 'required|min:2|max:255',
        'date' => 'required',
        'description' => 'nullable|min:2|max:3000',
		'file' => 'nullable|mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx|max:5000',
     );


    public static $about = array(
        'title' => 'required|min:2|max:255',
        'shot' => 'required|min:2|max:500',
        'description' => 'required|min:2',
    );
    public static $privacy = array(
        'title' => 'required|min:2|max:255',
        'description' => 'required|min:2',
    );
    public static $terms = array(
        'title' => 'required|min:2|max:255',
        'description' => 'required|min:2',
    );
	public static $email_template = array(
        'title' => 'required|min:2|max:255',
        'body' => 'required|min:2',
    );
    public static $faq = array(
        'title' => 'required|min:2|max:255',
        'description' => 'required|min:2',
        //'visible'=>'required'
    );
    public static $tutorplan = array(
        'title' => 'required|min:2|max:255',
        'sub_title' => 'required|min:2',
        // 'price' => 'required|min:2|max:50',
        'duration' => 'required|min:2|max:255',
        'status' => 'required',
        'details' => 'required|min:2',
        'post_assignment' => 'required',
        'premium' => 'required',
        'book_tutor' => 'required',
        'image' => 'required',
        //'visible'=>'required'
    );
    public static $tutorplan_edit = array(
        'title' => 'required|min:2|max:255',
        'sub_title' => 'required|min:2',
        // 'price' => 'required|min:2|max:50',
        'duration' => 'required|min:2|max:255',
        'status' => 'required',
        'details' => 'required|min:2',
        'post_assignment' => 'required',
        'premium' => 'required',
        'book_tutor' => 'required',
        // 'image' => 'required',
        //'visible'=>'required'
    );
    public static $employerplan = array(
        'title' => 'required|min:2|max:255',
        'sub_title' => 'required|min:2',
        'details' => 'required|min:2',
        'image' => 'required',
    );
    public static $employerplan_edit = array(
        'title' => 'required|min:2|max:255',
        'sub_title' => 'required|min:2',
        'details' => 'required|min:2',
    );
    public static $logo = array(
        'company_name' => 'required|min:2|max:255',
        'image' => 'required',
    );
    public static $logo_edit = array(
        'company_name' => 'required|min:2|max:255',
    );

    public static $assignJob = array(
        'tutor_assign' => 'required',
        'job_id' => 'required',
    );

    public static $stripeValid = array(
        'card_no' => 'required',
        'ccExpiryMonth' => 'required',
        'ccExpiryYear' => 'required',
        'cvvNumber' => 'required',
    );


    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
