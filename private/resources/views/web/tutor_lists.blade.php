@extends('layouts.dashboard')
@section('section')
@section('pageTitle', 'Tutor list')
<section class="inner-page-title">
    <div class="container">
        <div class="form-wrap">
            <h2>Find A Tutor <i class="fas fa-angle-down"></i></h2>
            @include('includes.search_form')
        </div>
    </div>
</section>
<section id="tutors-listing">
    <div class="container">
        <div class="listing-wrap">
            @if(empty($usersMeta['data']))
            <div class="alert alert-primary">
                  <strong>!</strong> No tutor matching your search criteria. Please try with other search terms.
            </div>
            @endif
            <?php //echo  '<pre>';print_r($usersMeta['data']);
			$link=str_replace(url()->current(),'',url()->full());?>

            @foreach($usersMeta['data'] as $user)
            <div class="row no-gutters list-items">
                <div class="col-md-3">
                    <div class="img-wrap">
                        <a href="{{url('tutors/').'/'.encrypt($user['user']['id']).$link}}">
                            @if (empty(\Sentinel::check()))
                            <img class="img-fluid blurr" src="{{$user['user']['photo'] ? asset('images/photo/').'/'.$user['user']['photo'] : asset('images/photo/dummy.png')}}">
                            @else
                            @if ($usercheck = Sentinel::getUser())
                            @if ($usercheck->inRole('tutor'))
                            <img class="img-fluid blurr" src="{{$user['user']['photo'] ? asset('images/photo/').'/'.$user['user']['photo'] : asset('images/photo/dummy.png')}}">
                            @else
                            <img class="img-fluid" src="{{$user['user']['photo'] ? asset('images/photo/').'/'.$user['user']['photo'] : asset('images/photo/dummy.png')}}">
                            @endif
                            @endif
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="text-wrap">
                        <a class="tutor-name" href="{{url('tutors/').'/'.encrypt($user['user']['id']).$link}}">
                            {{--<h4 class="media-heading">{{substr($user['user']['first_name'],'0',1  ) . str_repeat("*", strlen($user['user']['first_name'])-1)}}
                            {{substr($user['user']['last_name'],'0',1  ) . str_repeat("*", strlen($user['user']['last_name'])-1)}}
                            </h4>--}}
                            <h4>{{$user['uuid']}}</h4>
                        </a>
                        @if($user['status'] == '0')
                        <span class="verified">Undergoing Verification</span>
                        @else
                        <span class="verified">Verified</span>
                        @endif
                        <p><span class="rating_no">{{$rating = number_format($user['rating'], 1)}}</span><img
                                src="{{asset('images/photo/Star_rating_').$user['rating'].'.png'}}"></p>
                        <p class="sub-str">{{str_limit($user['about'], 100).'...'}}</p>
                        <div class="skills">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p><strong>Available in Location(s):</strong>
                                        @foreach($user['country'] as $country_level)
                                        <span class="country">{{$country_level['name']}}</span>
                                        @endforeach
                                    </p>
                                    {{--<p><strong>Country:</strong><span>{{$user['country']['name']}}</span></p>--}}
                                </div>

                            </div>
                        </div>
                        <div class="skills">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered table-responsive-lg"
                                        style="width:100%">

                                        <thead>
                                            <th>Skill</th>
                                            <th>Tutor Type</th>
                                            <th>Qualified Level</th>
                                            <th>Day Rate</th>
                                        </thead>
                                        @php $i=0;@endphp
                                        @foreach($user['categories'] as $categorie)
                                        <tr>
                                            <td>
                                                <p><span>{{$categorie['name']}}</span></p>
                                            </td>
                                            <td>
                                                <p><span>{{$user['disciplines'][$i]['name']}}</span></p>
                                            </td>
                                            <td>
                                                <p><span>{{$user['qualified_level'][$i]['level']}}</span></p>
                                            </td>
                                            <td>
                                                <p><span class="rate_color">@if(array_key_exists("rates",$user)){{'£'.$user['rates'][$i]}}
                                                        @endif</span></p>
                                            </td>
                                        </tr>
                                        <!--<div class="row">
					
						<div class="col-sm-4">
						<p><strong>Skill: </strong><span>{{$categorie['name']}}</span></p>
						</div>
						<div class="col-sm-4">
						<p><strong>Tutor Type: </strong><span>{{$user['disciplines'][$i]['name']}}</span></p>
						</div>
						<div class="col-sm-2">
						<p><strong>Level: </strong><span>{{$user['qualified_level'][$i]['level']}}</span></p>
						</div>
						<div class="col-sm-2">
						<p><strong>Day Rate: </strong><span class="rate_color">@if(array_key_exists("rates",$user)){{'£'.$user['rates'][$i]}} @endif</span></p>
						</div>
					</div>-->
                                        @php $i++; @endphp
                                        @endforeach

                                    </table>

                                </div>

                            </div>
                        </div>
                        <?php //print_r($user);?>
                    </div>
                </div>


                <div class="skills">
                    <div class="row">
                        <!--
         <div class="col-sm-4">
             @foreach($user['categories']  as $categorie)
                 <p><strong>Skill:</strong><span>{{$categorie['name']}}</span></p>
             @endforeach
         </div>
         <div class="col-sm-3">
             @foreach($user['disciplines']  as $discipline)
                 <p><strong>Type:</strong><span>{{$discipline['name']}}</span></p>
             @endforeach
         </div>
         <div class="col-sm-2">
             @foreach($user['qualified_level']  as $qualified_level)
                 <p><strong>Level:</strong><span>{{$qualified_level['level']}}</span></p>
             @endforeach
         </div>
         <div class="col-sm-3">
         @if(array_key_exists("rates",$user))
         @foreach($user['rates']  as $rate)
         <p><strong>Day Rate:</strong><span class="rate_color">{{'£'.$rate}}</span></p>
         @endforeach
         @endif
            
         </div>-->
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if ($usersMeta['last_page'] > '1')
        <ul class="pagination">
            @if ($usersMeta['prev_page_url'] != '')
            <li class="page-item "><a class="page-link"
                    href="{{$usersMeta['prev_page_url'] . '&'. strstr($_SERVER['QUERY_STRING'], 'specialist')}}">Previous</a>
            </li>
            @endif
            @for($i = 1; $i <= $usersMeta['last_page']; $i++) <li
                class="page-item {{$usersMeta['current_page'] == $i ? 'active' : ''}} "><a class="page-link"
                    href="{{$usersMeta['path']. '?page=' . $i . '&'. strstr($_SERVER['QUERY_STRING'], 'specialist') }}">{{$i}}</a>
                </li>
                @endfor
                @if ($usersMeta['next_page_url'] != '')
                <li class="page-item"><a class="page-link"
                        href="{{$usersMeta['next_page_url'] . '&'. strstr($_SERVER['QUERY_STRING'], 'specialist')}}">Next</a>
                </li>
                @endif
        </ul>
        @endif
    </div>

</section>
@stop