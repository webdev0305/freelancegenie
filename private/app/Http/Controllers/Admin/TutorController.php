<?php

namespace App\Http\Controllers\Admin {

    use App\Http\Requests\ValidationRequest;
    use App\Model\Activations;
    use App\Model\Category;
    use App\Model\CategoryUser;
    use App\Model\Country;
    use App\Model\CountryUser;
    use App\Model\Course;
    use App\Model\Discipline;
    use App\Model\Disciplines;
    use App\model\Educations;
	use App\model\Jobs;
    use App\Model\Language;
    use App\Model\Organisations;
    use App\Model\QualifiedLevel;
    use App\Model\Skill;
    use App\Model\Specialization;
    use App\model\TutorProfile;
	use App\Model\Invoice;
    use App\model\Students;
	use App\Model\EmailTemplate;
	use App\Model\Subscription;
	use App\Model\TeachingCertificates;
    use App\Model\GlobalSettings;
    use App\User;
    use App\Model\UserDoc;
    use Illuminate\Support\Facades\Config;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Schema;
	use Illuminate\Support\Facades\Response;
	use Illuminate\Support\Facades\Input;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use View;
    use Yajra\DataTables\DataTables;
    use Illuminate\Support\Facades\Session;

    /**
     * @property  dataTable
     */
    class TutorController extends Controller
    {
        private $dataTable;

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return View::make('admin.tutors_view');
        }
        public function uploadSubmit(Request $request)
        {
            foreach ($request->photos as $photo) {
                $original=$photo->getClientOriginalName();
                $filename = $photo->store('photos');
                UserDoc::create([
                    'user_id' => \Sentinel::getUser()->id,
                    'filename' => $filename,
                    'originalname' =>$original,
                    'global' =>1
                ]);
            }
            Session::flash('success','Upload successful!');
            return Redirect::back();
        }


        /**
         * @return mixed
         * @throws \Exception
         */
       
        public function viewTutors()
        {
            $users = User::whereHas('roles', function ($q) {
                $q->whereIn('slug', ['tutor']);
            })->orderBy('id','desc')->get();

            return Datatables::of($users)
                ->addColumn('actions', function ($userd) {
                    $UsrActCkh = Activations::where('user_id', $userd->id)->first();
                    return empty($UsrActCkh) || $UsrActCkh['completed'] == '0' ? '<button type="button" id="activateTutor" value=' . encrypt($userd->id) . ' class="btn btn-square btn-option3 btn-icon wdth red_btn"><i class="fa fa-lock"></i></button><a   href="href="tutor/' . encrypt($userd->id) . '/edit"  class="btn btn-square btn-option3 btn-icon wdth red_btn"><i class="fa fa-edit"></i></a><a  href="tutor/' . encrypt($userd->id) . '"   class="btn btn-square btn-option3 btn-icon wdth red_btn"><i class="fa fa-eye"></i></a>' : '<button type="button" id="activateTutor" value=' . encrypt($userd->id) . ' class="btn btn-square btn-option3 btn-icon wdth g_btn"><i class="fa fa-unlock"></i></button><a  href="tutor/' . encrypt($userd->id) . '/edit"   class="btn btn-square btn-option3 btn-icon wdth red_btn"><i class="fa fa-edit"></i></a><a href="tutor/' . encrypt($userd->id) . '"   class="btn btn-square btn-option3 btn-icon wdth red_btn"><i class="fa fa-eye"></i></a>';
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make();

        }
		public function InvoicetoAccountant(Request $request)
        {	
			try{
			$data = $request->input();
			$invoices=Jobs::with('Invoice')->whereIn('id',$data['ids'])->get();
			foreach($invoices as $invoice){
				$booking_days=count(explode(',',$invoice->date));
				$content='<table id="example" class="table table-striped table-bordered table-responsive-lg" style="width:100%">
            <thead>
            <tr>
                <th>Booking Id</th>
				<th>Booking Dates</th>
				<th>Attended Date</th>
				<th>Tutor Rate</th>';
				if($invoice->hotel_charges >0){
				$content.='<th>Hotel Charges</th>
				<th>Travel Cost Hotel to Booking Venue</th>';
				}else{
				$content.='<th>Travel Cost Tutor Venue to Booking Venue</th>';
				} 
				$content.='<th>Cost per Day</th>
			</tr>
            </thead>
            <tbody>';
			$i = 1; $subtotal=0; $travel_cost_h=0; $travel_cost=0;
			if(sizeof($invoice['Invoice'])>0){
             foreach($invoice['Invoice'] as $key=>$inv){
				 if($inv->sent == 1){
				$content.='<tr>
                    <td>'.$inv->booking_no.'</td>
					<td>'.$invoice->date.'</td>
					<td>'.$inv->date.'</td>
					<td>£'.$inv->rate.'</td>';
					if($invoice->hotel_charges >0){
					$hot_booking_dist=15;
					$content.='<td>£'.$invoice->hotel_charges.'</td>
					<td>£';$travel_cost=2*$hot_booking_dist*0.30;
					$content.=$travel_cost.'</td>';
					}else{
					$content.='<td>£';$travel_cost=2*$invoice->distance*0.30;
					$content.=$travel_cost.'</td>';
					}
					$content.='<td>£';$day_total=$inv->rate+$travel_cost+$invoice->hotel_charges;
					$content.=$travel_cost.'</td>
					</tr>';
				$i++;
				$subtotal +=$day_total;
				 }
			 }
			 if($invoice->hotel_charges >0){
			 $content.='<tr class="subtotal">
				<td colspan="5"></td>
				<td>Travel Cost Tutor - Booking Venue</td>
				<td>£';$travel_cost_h=2*$invoice->distance*0.30;
				$content.=$travel_cost_h.'</td>
			  </tr>';
			  }
				$content.='<tr class="subtotal">
				<td colspan="';
				if($invoice->hotel_charges >0){
					$content.= 5;
					}else{
					$content.= 4;
					}
					$content.='"></td>
				<td>Subtotal</td>
				<td>£';$subtotal=$subtotal+$travel_cost_h;
				$content.=$subtotal.'</td>
			  </tr>
			  <tr>
			   <td colspan="';
			   if($invoice->hotel_charges >0){
				   $content.= 5;
				   }else{
					$content.= 4;
					}
					$content.='"></td>
				<td>20% VAT</td>
				<td>£';$vat=20/100*$subtotal;
				$content.=$vat.'</td>
			  </tr>
			  <tr class="subtotal">
				<td colspan="';
				if($invoice->hotel_charges >0){
					$content.= 5;
					}else{
					$content.= 4;
						}
					$content.='"></td>
				<td>Total</td>
				<td>£';
				$total=$subtotal+$vat;
				$content.=$total.'</td>
			  </tr>
			  <tr class="subtotal">
				<td colspan="';
				if($invoice->hotel_charges >0){
					$content.= 5;
					}else{
						$content.= 4;
						}
						$content.='"></td>
				<td>FTA Deduction(10%)</td>
				<td>£';
				$fta_deduct=10/100*$total;
				$content.=$fta_deduct.'</td>
			  </tr>
			  <tr class="subtotal">
				<td colspan="';
				if($invoice->hotel_charges >0){
					$content.= 5;
					}else{
						$content.= 4;
						}
						$content.='"></td>
				<td>Amount Payable</td>
				<td>£';$total=$total-$fta_deduct;
				$content.=$total.'</td>
			  </tr>';
			  }
				$content.='</tbody></table>';
				$content.='<p>Thanks</p>
				<p>Freelance Genie</p>';
					//die($content);
				$to = "krishankmr.bbdit@gmail.com";
				$from ="info@freelancegenie.co.uk";
				$subject = 'Freelance Genie Invoice';
                $email_template = EmailTemplate::first();
				$title = '<title>Freelance Genie Invoice</title>';
				$message=str_replace('<title></title>',$title,$email_template->body);
				$message=str_replace('<p></p>',$content,$message);
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				// More headers
				$headers .= 'From: <'.$from.'>' . "\r\n";
            //    mail($to,$subject,$message,$headers);
    
			}
			$invoice=Invoice::whereIn('booking_no',$data['ids'])->update(['sent'=>2]);
			Session::flash('success','Invoice Successfully Sent to Accountant');
			return Response::json(['success' => '1','message' => 'Invoice Successfully Sent to Accountant']);
			}catch( \Exception $e ){
			return Response::json(['success' => '0','message' => $e->getMessage()]);	
			}
		}
		

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
        }
        public function invoice()
        {
           //$invoice = Invoice::where('sent',"1")->get(); // commented on 28-09-2019
		   $invoice=Jobs::with('Invoice')->whereHas('Invoice', function ($q) {
            $q->where('invoices.sent', '=', "1");
			})->get();
		  
		  // echo '<pre>';print_r($invoice);
		  // die('I am here');
		   foreach($invoice as $key1=>$inv1){
		   $i = 1;$subtotal=0;$travel_cost_h=0;$travel_cost=0;$hot_booking_dist=15;
		   if(sizeof($inv1['Invoice'])>0){
			   foreach($inv1['Invoice'] as $key=>$inv){
				   if($inv->sent == 1){
				$inv1->invoice_no=$inv->invoice_no;
				if($inv1->hotel_charges >0){
				$travel_cost=2*$hot_booking_dist*0.30;
				}else{
				$travel_cost=2*$inv1->distance*0.30;
				}
				$day_total=$inv->rate+$travel_cost+$inv1->hotel_charges;
				$i++;
				$subtotal+=$day_total;  
				   }
			   }
			   if($inv1->hotel_charges >0){
				$travel_cost_h=2*$inv1->distance*0.30;
				}
				$subtotal=$subtotal+$travel_cost_h;
				$vat=20/100*$subtotal;
				$total=$subtotal+$vat;
				$fta_deduct=10/100*$total;
				$total=$total-$fta_deduct;
				$inv1->total=$total;
				
		   }
		   }
		   //echo '<pre>';print_r($invoice);
		   //die('I am here');
           return View('admin.sent_invoice', compact('invoice'));
        }
		public function ViewInvoice($id){ 
            $invoice=Jobs::with('Invoice')->where('id',$id)->first();
            $mileage=GlobalSettings::where('name','mileage')->first()->value;
            $vat_rate=GlobalSettings::where('name','vat')->first()->value;
			return view('web/invoice', compact('invoice','mileage','vat_rate')); 
		}		
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            //
        }

        public function tutorApproved(Request $request)
        {
            $data = $request->input();

            if($data['checkVal'] == 'true'){
              $staus = '1';
              $message = 'Tutor Approved';
            }else{
              $staus = '0';
                $message = 'Tutor Not Approved';
            }

            $tuPro = TutorProfile::whereUserId($data['tutor_id'])->first();
            $tuPro->status = $staus;
            $tuPro->save();
            echo $message;
        }

        /**
         * Display the specified resource.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $usersMeta = json_decode(json_encode(User::with(['Country', 'TutorProfile', 'Categories', 'OrganisationsWork', 'QualifiedLevel'])->find(decrypt($id))));
            $array = array();
            $ttrLan = json_decode(json_encode(Language::whereIn('id', $usersMeta->tutor_profile->language_id != '' ? unserialize($usersMeta->tutor_profile->language_id) : $array)->get()));
            $ttrLocaWill = json_decode(json_encode(Country::whereIn('id', $usersMeta->tutor_profile->language_id != '' ? unserialize($usersMeta->tutor_profile->travel_location) : $array)->get()));
            $categories = Category::with('children')->get();
			$subs =  Subscription::with('plan')->whereUserId(decrypt($id))->first();
            return View('admin.tutor_view', compact('usersMeta', 'ttrLan', 'categories', 'ttrLocaWill','subs'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $usersMeta = json_decode(json_encode(User::with(['Country', 'TutorProfile', 'Categories', 'OrganisationsWork', 'QualifiedLevel', 'Disciplines'])->find(decrypt($id))));
            $categorieUser = empty($usersMeta->categories) ? json_decode(json_encode(array(array('id' => '0', 'name' => '', 'pivot' => array('level' => '')))), false) : $usersMeta->categories;
            $categories = Category::with('children')->get();
            $organisations = empty($usersMeta->organisations_work) ? json_decode(json_encode(array(array('id' => '0', 'registration' => '', 'company_name' => ''))), false) : $usersMeta->organisations_work;
            $levels = QualifiedLevel::with('childrenLevels')->orderBy('priority','asc')->get();
            $disciplines = Disciplines::with('childrenDisciplines')->orderBy('priority','asc')->get();
            $countries = Country::with('children')->get();
            $countryUser[] = '';
            if (isset($usersMeta->country['0'])) {
                foreach ($usersMeta->country as $countryUse) {
                    $countryUser[] = $countryUse->id;
                }
            }
			
            return View('admin.tutors_edit', compact('usersMeta', 'categories', 'categorieUser', 'organisations', 'levels', 'disciplines', 'countries', 'countryUser'));

        }


        private function GetTutor($id, $view)
        {

        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            try {
            
                $data = $request->input();
                $validation = Validator::make($request->all(), ValidationRequest::$userValid);
                
                if ($validation->fails()) {
                
                    $errors = $validation->messages();
                    //die($errors);
                    return Redirect::back()->with('errors', $errors);
                }

                $user = User::find(decrypt($id));
                $user->first_name = $data['first_name'];
                $user->last_name = $data['last_name'];
                $user->phone = $data['phone'];

                //Check User Photo
                if (!empty($request->file())) {
                    $file = $request->file();
                    if (isset($file['photo'])) {
                        $user->photo = $this->UploadFile($file, 'photo', $user->photo);
                    }
                }

                // convert seconds into a specific format
                    
                if ($user->save()) {
                
                    $tutrPro = $user->TutorProfile()->whereUserId(decrypt($id))->first();
                    $tutrPro->city = $data['city'];
                    $tutrPro->street_name = $data['street_name'];
                    $tutrPro->country_id = $data['country'];
                    $tutrPro->address = $data['address'];
                    $tutrPro->zip = $data['zip'];
                    $tutrPro->about = $data['about'];
					$tutrPro->tutor_company_name = $data['tutor_company_name'];
					 $tutrPro->company_address = $data['company_address'];
					 $tutrPro->comp_street_name = $data['comp_street_name'];
					 $tutrPro->comp_city = $data['comp_city'];
					 $tutrPro->comp_country_id = $data['comp_country'];
					 $tutrPro->comp_postcode = $data['comp_postcode'];
					 $tutrPro->contact_tel = $data['contact_tel'];
					 $tutrPro->comp_email = $data['comp_email'];
					 $tutrPro->company_vat_reg_no = $data['company_vat_reg_no'];
					$tutrPro->company_reg_no = $data['company_reg_no'];
                    $tutrPro->driving_license = $data['driving_license'];
                    $tutrPro->work_in_uk = $data['work_in_uk'];
                    
                    $tutrPro->certificate_issued = $data['certificate_issued'];
                    $tutrPro->cert_issued = $data['cert_issued'];
					$tutrPro->work_permit_option = $data['rtowork'];
					$tutrPro->indifinite_st = isset($data['indifinite_st'])?$data['indifinite_st']:"0";
					$tutrPro->indifinite_workperm = isset($data['indifinite_workperm'])?$data['indifinite_workperm']:"0";
					$tutrPro->indifinite_homedoc = isset($data['indifinite_homedoc'])?$data['indifinite_homedoc']:"0";
                    $tutrPro->pass_start_date = $data['pass_start_date'];
                    $tutrPro->pass_expiry_date = $data['pass_expiry_date'];
                    $tutrPro->passport_no = $data['passport_no'];
                    $tutrPro->permit_start_date = $data['permit_start_date'];
                    $tutrPro->permit_expiry_date = $data['permit_expiry_date'];
                    $tutrPro->permit_no = $data['permit_no'];
                    $tutrPro->dbs_certificate_no = $data['dbs_certificate_no'];
					$tutrPro->dbs_update = $data['dbs_update'];
					
					$tutrPro->dbs_reg_update_date = $data['dbs_reg_update_date'];
					$tutrPro->dbs_service_id = $data['dbs_service_id'];
					//$tutrPro->dbs_organisation = $data['dbs_organisation'];
					//$tutrPro->dbs_forename = $data['dbs_forename'];
					//$tutrPro->dbs_surname = $data['dbs_surname'];
				
                    $tutrPro->dbs_cert = $data['dbs_cert'];
                    //die('I am here');
                    $tutrPro->bank = $data['bank'];
                    $tutrPro->account_fname = $data['account_fname'];
                    $tutrPro->account_no = $data['account_no'];
                    $tutrPro->bank_code = $data['bank_code'];
					$tutrPro->ref1_company_name = $data['ref1_company_name'];
					 $tutrPro->ref1_name = $data['ref1_name'];
					 $tutrPro->ref1_contact_tel = $data['ref1_contact_tel'];
					 $tutrPro->ref1_email = $data['ref1_email'];
					 $tutrPro->ref2_company_name = $data['ref2_company_name'];
					 $tutrPro->ref2_contact_tel = $data['ref2_contact_tel'];
					 $tutrPro->ref2_email = $data['ref2_email'];
					 $tutrPro->ref2_name = $data['ref2_name'];
					$tutrPro->internet_update_service = $data['internet_update_service'];
                    //$tutrPro->disabilities = $data['disabilities'];
                    $tutrPro->medical_conditions = $data['medical_conditions'];
					$tutrPro->medical_description = $data['medical_description'];
                    //$tutrPro->level_of_fluency = $data['level_of_fluency'];// commented 05-09-2019
                    //$tutrPro->willing_travel = $data['willing_travel'];
                    $tutrPro->travel_location = isset($data['travel_location']) ? serialize($data['travel_location']) : '';
                    //$tutrPro->speak_languages = 1; // commented 04-08-2019
                    $tutrPro->language_id = isset($data['language']) ? serialize($data['language']) : '';
                    //Check User Photo
                    if (!empty($request->file())) {
                        $file = $request->file();
                        if (isset($file['cv'])) {
                            $tutrPro->cv = $this->UploadFile($file, 'cv', $tutrPro->cv);
                        }
						if (isset($file['drl'])) {
                            $tutrPro->drl = $this->UploadFile($file, 'drl', $tutrPro->drl);
                        }
                        if (isset($file['dbs_cert_upload'])) {
                            $tutrPro->dbs_cert_upload = $this->UploadFile($file, 'dbs_cert_upload', $tutrPro->dbs_cert_upload);
                        }
                        
                        if (isset($file['teaching_qual'])) {
                            $tutrPro->teaching_qual = $this->UploadFile($file, 'teaching_qual', $tutrPro->teaching_qual);
                        }
                        
                        if (isset($file['passport'])) {
                            $tutrPro->passport = $this->UploadFile($file, 'passport', $tutrPro->passport);
                        }
                        if (isset($file['work_permit'])) {
                            $tutrPro->work_permit = $this->UploadFile($file, 'work_permit', $tutrPro->work_permit);
                        }
                        if (isset($file['birth_certificate'])) {
                            $tutrPro->birth_certificate = $this->UploadFile($file, 'birth_certificate', $tutrPro->birth_certificate);
                        }
                    }
                    $tutrPro->save();
                }

                //     $user->Disciplines()->sync(isset($data['disciplines']) ? $data['disciplines'] : []);

                if ($data['certificates_id']) {
					//die('here');
                    CategoryUser::whereUserId(decrypt($id))->delete();
                    $sync_data = array();
					
                    for ($i = 0; $i < count($data['certificates_id']); $i++) {
						$sync_data[$data['certificates_categorie'][$i]] = array('disciplines_id' => $data['disciplines_level'][$i],
						'qualified_levels_id' => $data['certificates_level'][$i],
						'rate' => $data['certificates_rate'][$i],
						'valid' => $data['certificates_valid'][$i]);
						}
						//print_r($data['certificates_valid']);die('here');
                    $user->Categories()->attach($sync_data);

                }
				if (Input::hasFile('certificates_upload')){  

            try{  

            foreach ($request->certificates_upload as $photo) {

            $original=$photo->getClientOriginalName();              

            $filename = $photo->store('certificates_upload');             

            \App\Model\TeachingCertificates::create([ 

            'tutor_id' => decrypt($id),             

            'filename' => $filename,

            'originalname' =>$original,             

            ]);            }                         

            }catch(\Exception $e){// do task when error            

            die($e->getMessage());

            }   

            }
				if (Input::hasFile('professionalbodies_upload')){  

            try{  

            foreach ($request->professionalbodies_upload as $photo) {

            $original=$photo->getClientOriginalName();              

            $filename = $photo->store('professionalbodies_upload');             

            \App\Model\TeachingCertificates::create([ 

            'tutor_id' => decrypt($id),             

            'filename' => $filename,

            'originalname' =>$original,
			'type' =>1,			

            ]);            }                         

            }catch(\Exception $e){// do task when error            

            die($e->getMessage());

            }   

            }

                if ($data['travel_location']) {
                    $user->Country()->sync($data['travel_location']);
                }

                if ($data['work_id']) {
                    for ($i = 0; $i < count($data['work_id']); $i++) {
                        $user->OrganisationsWork()->whereUserId(decrypt($id))->delete();
                        for ($i = 0; $i < count($data['work_id']); $i++) {
                            $user->OrganisationsWork()->save(
                                new Organisations([
                                    'company_name' => $data['company_name'][$i],
                                    'registration' => $data['organization_registration'][$i],
                                ]));
                        }
                    }
                }
                Session::flash('success', Config::get('message.options.UPDATE_SUCCESS'));
                return Redirect::back();
            } catch (Exception $ex) {
            //die($ex->getMessage());
                return View::make('errors.exception')->with('Message', $ex->getMessage());
            }
        }


        private function UploadFile($file, $path, $name)
        {
            $time = time();
            $namefile = $time . '.' . $file[$path]->getClientOriginalExtension();

            $destinationPath = 'images/' . $path;
            $file[$path]->move($destinationPath, $namefile);
            //Delete old image
            $profileImg = $destinationPath . '/' . $name;

            if (\File::exists(public_path($profileImg))) {
                \File::delete(public_path($profileImg));
            }
            return $namefile;
        }


        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }

        public function tutor_update_rate()
        {
            // Schema::drop('users');
            // Schema::drop('migrations');
            // Schema::drop('subscription');
            // Schema::drop('jobs');
        }
    }
}

//