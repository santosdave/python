@extends('properties.edit')
@section('content')
<div class="step-9">
    <div class="card">
        {{-- <div class="card-header bg-secondary text-white">Seasons & Basis</div> --}}
        <div class="card-body">
            <h3>Facilities</h3>
            <div class="d-flex justify-content-end">
                {{-- <button wire:click.prevent="selectFacilities" class="btn btn-success btn-sm ml-2"><i
                        class="fa fa-plus-circle mr-1"></i> Add</button> --}}
            </div>
            @php
            $facilities = DB::table('facilities')->where('property_id',$property->id)->get();
            /* $amenities = DB::table('amenities')->where('property_id',$property->id)->get(); */
            $services = DB::table('services')->where('property_id',$property->id)->get();
            $additional_fees = DB::table('additional_fees')->where('property_id',$property->id)->get();
            @endphp

            <table class="facility table stripped">
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Price Type</th>
                        <th>Currency</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Confirmation Required</th>
                        <th>Terms & Conditions</th>
                        <th>Enable</th>

                        <th> <a href="javascript:void(0)" class="btn btn-success btn-sm ml-2" data-toggle="modal"
                                data-target="#facilitiesModal"><i class="fa fa-plus-circle mr-1"></i>
                            </a></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($facilities as $facility )

                    <tr id="facid{{$facility->id}}">
                        <td>
                            <p>{{strtoupper($facility->facility ?? '')}}</p>
                        </td>
                        <td>
                            <p>{{strtoupper($facility->price_type ?? 'none')}}</p>
                        </td>
                        <td>
                            <p>{{strtoupper($facility->currency ?? 'none')}}</p>
                        </td>
                        <td>
                            <p>{{strtoupper($facility->price ?? 'none')}}</p>
                        </td>
                        <td>
                            <p>{{strtoupper($facility->duration ?? 'none')}}</p>
                        </td>
                        <td>
                            <p>{{strtoupper($facility->confirmation_type ?? 'none')}}</p>
                        </td>
                        <td>
                            <a href="javascript:void(0)" data-toggle="modal"
                                data-target="#viewtermsFacilityModal-{{$facility->id}}"><i
                                    class="fa fa-eye text-primary ml-2 mr-1 "></i></a>
                        </td>
                        <td>
                            <p>{{strtoupper($facility->enable ?? 'none')}}</p>

                        </td>

                        <td>
                            <a href="javascript:void(0)" onclick="editFacility({{$facility->id}})"><i
                                    class="fa fa-edit mr-2 "></i></a>
                            <a href="javascript:void(0)" onclick="deleteFacility({{$facility->id}})"><i
                                    class="fa fa-trash text-danger "></i></a>
                        </td>

                    </tr>
                    <!-- View Facility Terms & ConditionsModal -->
                    <div class="modal fade viewtermsFacilityModal" id="viewtermsFacilityModal-{{$facility->id}}"
                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">{{$facility->facility ?? 'Facility'}}
                                        -Facility Terms and Conditions</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="Price Type">Terms and Conditions</label>
                                        <textarea class="form-control" name="rate" disabled>{{$facility->terms_and_conditions ?? 'none'}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- View Facility Terms & ConditionsModal -->
                    @empty
                    <div class="text-danger">You have not added any Facilities for this property. Click "Add"
                    </div>
                    @endforelse



                </tbody>


            </table>

            <hr>
            {{-- <h3>Amenities</h3>
            <table class="amenity table stripped">
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Price Type</th>
                        <th>Currency</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Confirmation Required</th>
                        <th>Terms & Conditions</th>
                        <th>Enable</th>

                        <th> <a href="javascript:void(0)" class="btn btn-success btn-sm ml-2" data-toggle="modal"
                                data-target="#amenitiesModal"><i class="fa fa-plus-circle mr-1"></i></a>
                        </th>



                    </tr>
                </thead>
                <tbody>
                    @forelse ($amenities as $amenity )

                    <tr id="amid{{$amenity->id}}">
                        <td>
                            <p>{{strtoupper($amenity->amenity ?? '')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($amenity->price_type ?? 'none')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($amenity->currency ?? 'none')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($amenity->price ?? 'none')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($amenity->duration ?? 'none')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($amenity->confirmation_type ?? 'none')}}</p>

                        </td>
                        <td>
                            <a href="javascript:void(0)" data-toggle="modal"
                                data-target="#viewTermsAmenityModal-{{$amenity->id}}"><i
                                    class="fa fa-eye text-primary ml-2 mr-1 "></i></a>
                        </td>
                        <td>
                            <p>{{strtoupper($amenity->enable ?? 'none')}}</p>
                        </td>

                        <td valign="top">
                            <a href="javascript:void(0)" data-toggle="modal"
                                data-target="#editAmenityModal-{{$amenity->id}}"><i class="fa fa-edit mr-2 "></i>

                            </a>

                            <a href="javascript:void(0)" data-toggle="modal"
                                data-target="#deleteAmenityModal-{{$amenity->id}}"><i
                                    class="fa fa-trash text-danger "></i>
                            </a>
                        </td>
                    </tr>
                    <!-- View Amenity Terms & ConditionsModal -->
                    <div class="modal fade viewTermsAmenityModal" id="viewTermsAmenityModal-{{$amenity->id}}"
                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">{{$amenity->amenity ??
                                        'Amenity'}}-Amenity
                                        Terms and Conditions</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="Price Type">Terms and Conditions</label>
                                        <textarea class="form-control" name="rate" disabled>{{$amenity->terms_and_conditions ?? 'none'}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- View Amenity Terms & ConditionsModal -->
                    <!--EDIT AMENITIES MODAL---->
                    <div class="modal fade editAmenityModal" id="editAmenityModal-{{$amenity->id}}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel"> EDIT AMENITIES</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{route('amenity.update')}}">
                                        @csrf
                                        <input type="hidden" name="property_id" value="{{$property->id}}">
                                        <input type="hidden" name="id" id="id" value="{{$amenity->id}}">
                                        <input type="hidden" name="amenity" value="{{$amenity->amenity_name ?? '' }}">
                                        <div class="form-group">
                                            <label for="">Amenity Name</label>
                                            <input type="text"
                                                class="form-control @error('amenity') is-invalid @enderror"
                                                placeholder="" name="" value="{{$amenity->amenity ?? '' }}" disabled />
                                            @error('amenity')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Type">Price Type</label>
                                            <select name="price_type" id="price-type2"
                                                class="form-control @error('price_type') is-invalid @enderror"
                                                value="{{$amenity->price_type ?? '' }}">
                                                <option value='{{$amenity !==null && $amenity->price_type !==
                                                    null ? $amenity->price_type : ''}}' selected>
                                                    {{$amenity !== null && $amenity->price_type !== null ?
                                                    $amenity->price_type : 'Select Price Type'}}
                                                </option>
                                                <option value="free">FREE</option>
                                                <option value="per guest">Per Guest</option>
                                                <option value="per adult">Per Adult</option>
                                                <option value="per child">Per Child</option>
                                                <option value="per session">Per Session</option>
                                                <option value="per day">Per Day</option>
                                                <option value="per stay">Per Stay</option>
                                            </select>
                                            @error('price_type')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Currency">Price Currency</label>
                                            <select name="currency" id=""
                                                class="form-control @error('currency') is-invalid @enderror"
                                                value="{{$amenity->currency ?? '' }}">
                                                <option value='{{$amenity !==null && $amenity->currency !==
                                                    null ? $amenity->currency : ''}}' selected>
                                                    {{$amenity !== null && $amenity->currency !== null ?
                                                    $amenity->currency : 'Select Price Currency'}}
                                                </option>
                                                <option value="usd">USD</option>
                                                <option value="kes">KES</option>
                                            </select>
                                            @error('currency')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Value">Price Value</label>
                                            <input type="number" name="price" id="price-value2"
                                                class="form-control @error('price') is-invalid @enderror"
                                                placeholder="Price" value="{{$amenity->price ?? ''}}">
                                            @error('price')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="duration">Duration</label>
                                            <div class="form-group">
                                                <input type="text" name="duration"
                                                    class="form-control @error('duration') is-invalid @enderror"
                                                    value="{{$amenity->duration}}" />
                                            </div>
                                            @error('duration')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Type">Confirmation Required</label>
                                            <select name="confirmation_type" id=""
                                                class="form-control @error('confirmation_type') is-invalid @enderror"
                                                value="{{$amenity->confirmation_type ?? ''}}">
                                                <option value='{{$amenity !==null && $amenity->confirmation_type !== null ?
                                                    $amenity->confirmation_type: ''}}' selected>
                                                    {{$amenity !== null && $amenity->confirmation_type !==
                                                    null ? $amenity->confirmation_type : 'Select
                                                    Confirmation Type'}}
                                                </option>
                                                <option value="per guest">Per Guest</option>
                                                <option value="per session">Per Session</option>
                                                <option value="per day">Per Day</option>
                                                <option value="per stay">Per Stay</option>
                                            </select>
                                            @error('confirmation_type')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Type">Terms and Conditions</label>
                                            <textarea class="form-control" name="terms_and_conditions"
                                                value="{{$amenity->terms_and_conditions}}">{{$amenity->terms_and_conditions}}</textarea>
                                            @error('terms_and_conditions')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Type">Enable</label>
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input @error('amenity_status') is-invalid @enderror"
                                                    type="radio" name="enable" value="yes" id="" {{ $amenity !==null &&
                                                    $amenity->enable == 'yes' ? 'checked': ''}}>
                                                <label class="form-check-label" for="enable">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input @error('enable') is-invalid @enderror"
                                                    type="radio" name="enable" id="" value="no" {{ $amenity !==null &&
                                                    $amenity->enable == 'no' ? 'checked': ''}}>
                                                <label class="form-check-label" for="enable">
                                                    No
                                                </label>
                                            </div>
                                            @error('enable')
                                            <div class=" invalid-feedback">{{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- SUBMIT-->
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                            <button class="btn btn-success" type="submit"><i
                                                    class="fa fa-save mr-2"></i> Save Changes</button>

                                        </div>
                                        <!-- SUBMIT-->
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--EDIT AMENITIES MODAL---->
                    <!-- Delete Amenity Modal -->
                    <div class="modal fade deleteAmenityModal" id="deleteAmenityModal-{{$amenity->id}}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">DELETE AMENITY</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label class="control-label">Do you want to delete this Amenity</label>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Amenity Name</label>
                                            <input type="text" name="amenity" id="" class="form-control"
                                                value="{{$amenity->amenity ?? ''}}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Price Type</label>
                                            <input type="text" name="price_type" id="" class="form-control"
                                                value="{{$amenity->price_type ?? ''}}" disabled>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    <button class="btn btn-secondary">
                                        <a class="text-danger" href="{{route('amenity.delete', $amenity->id )}}">
                                            Delete
                                        </a>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Amenity Modal -->
                    @empty
                    <div class="text-danger">You have not added any Amenities for this property. Click "Add"
                    </div>
                    @endforelse
                </tbody>

            </table>
            <hr> --}}
            <h3>Services</h3>
            <table class="services table stripped">
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Price Type</th>
                        <th>Currency</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Confirmation Required</th>
                        <th>Terms & Conditions</th>
                        <th>Enable</th>

                        <th> <a href="javascript:void(0)" class="btn btn-success btn-sm ml-2" data-toggle="modal"
                                data-target="#servicesModal"><i class="fa fa-plus-circle mr-1"></i></a>
                        </th>



                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service )

                    <tr id="sid{{$service->id}}">
                        <td>
                            <p>{{strtoupper($service->services ?? '')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($service->price_type ?? 'none')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($service->currency ?? 'none')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($service->price ?? 'none')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($service->duration ?? 'none')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($service->confirmation_type ?? 'none')}}</p>

                        </td>
                        <td>
                            <a href="javascript:void(0)" data-toggle="modal"
                                data-target="#viewTermsServiceModal-{{$service->id}}"><i
                                    class="fa fa-eye text-primary ml-2 mr-1 "></i></a>
                        </td>
                        <td>
                            <p>{{strtoupper($service->enable ?? 'none')}}</p>
                        </td>

                        <td valign="top">
                            <a href="javascript:void(0)" data-toggle="modal"
                                data-target="#editServiceModal-{{$service->id}}"><i class="fa fa-edit mr-2 "></i>
                            </a>

                            <a href="javascript:void(0)" data-toggle="modal"
                                data-target="#deleteServiceModal-{{$service->id}}"><i
                                    class="fa fa-trash text-danger "></i>
                            </a>
                        </td>

                    </tr>
                    <!-- View Service Terms & ConditionsModal -->
                    <div class="modal fade viewTermsServiceModal" id="viewTermsServiceModal-{{$service->id ?? '' }}"
                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">{{$service->services ?? 'Services'}}
                                        -Service
                                        Terms and Conditions</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="Price Type">Terms and Conditions</label>
                                        <textarea class="form-control" name="service_terms_and_conditions" disabled>{{$service->terms_and_conditions ?? 'none'}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- View Service Terms & ConditionsModal -->

                    <!--EDIT SERVICES MODAL---->
                    <div class="modal fade editServiceModal" id="editServiceModal-{{$service->id}}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">EDIT SERVICES</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{route('service.update')}}">
                                        @csrf
                                        <input type="hidden" name="provider_id" id="provider_id"
                                            value="{{Auth::user()->provider_id}}">
                                        <input type="hidden" name="property_id" value="{{$property->id}}">
                                        <input type="hidden" name="id" id="id" value="{{$service->id}}">
                                        <input type="hidden" name="services" value="{{$service->services ?? ''}}">
                                        <div class="form-group">
                                            <label for="">Service Name</label>
                                            <input type="text"
                                                class="form-control @error('services') is-invalid @enderror"
                                                placeholder="" name="" value="{{$service->services ?? '' }}" disabled />
                                            @error('services')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Type">Price Type</label>
                                            <select name="price_type" id="price-type3"
                                                class="form-control @error('price_type') is-invalid @enderror"
                                                value="{{$service->price_type}}">
                                                <option value='{{$service !==null && $service->price_type !==
                                                    null ? $service->price_type :""}}' selected>
                                                    {{$service !== null && $service->price_type !== null ?
                                                    $service->price_type :"Select Price Type"}}
                                                </option>
                                                <option value="Free">FREE</option>
                                                <option value="Per Guest">Per Guest</option>
                                                <option value="Per Adult">Per Adult</option>
                                                <option value="Per Child">Per Child</option>
                                                <option value="Per Session">Per Session</option>
                                                <option value="Per Day">Per Day</option>
                                                <option value="Per Stay">Per Stay</option>
                                            </select>
                                            @error('price_type')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Currency">Price Currency</label>
                                            <select name="currency" id=""
                                                class="form-control @error('currency') is-invalid @enderror"
                                                value="{{$service->currency}}">
                                                <option value='{{$service !==null && $service->currency !==
                                                    null ? $service->currency :""}}' selected>
                                                    {{$service !== null && $service->currency !== null ?
                                                    $service->currency :"Select Currency"}}
                                                </option>
                                                <option value="USD">USD</option>
                                                <option value="KSH">KSH</option>
                                            </select>
                                            @error('currency')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Value">Price Value</label>
                                            <input type="number" name="price" id="price-value3"
                                                class="form-control @error('price') is-invalid @enderror"
                                                placeholder="Price" value="{{$service->price}}">
                                            @error('price')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="duration">Duration</label>

                                            <div class="form-group">
                                                <input type="text" name="duration"
                                                    class="form-control @error('duration') is-invalid @enderror"
                                                    value="{{$service->duration}}" />
                                            </div>
                                            @error('duration')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Type">Confirmation Required</label>
                                            <select name="confirmation_type" id=""
                                                class="form-control @error('confirmation_type') is-invalid @enderror"
                                                value="{{$service->confirmation_type}}">
                                                <option value='{{$service !==null && $service->confirmation_type !== null ?
                                                    $service->confirmation_type :""}}' selected>
                                                    {{$service !== null && $service->confirmation_type !==
                                                    null ? $service->confirmation_type :"Select Confirmation
                                                    Type"}}
                                                </option>
                                                <option value="Per Guest">Per Guest</option>
                                                <option value="Per Session">Per Session</option>
                                                <option value="Per Day">Per Day</option>
                                                <option value="Per Stay">Per Stay</option>
                                            </select>
                                            @error('confirmation_type')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="terms">Terms and Conditions</label>
                                            <textarea
                                                class="form-control @error('terms_and_conditions') is-invalid @enderror"
                                                name="terms_and_conditions"
                                                value="{{$service->terms_and_conditions ?? '' }}">{{$service->terms_and_conditions ?? ''}}</textarea>
                                            @error('terms_and_conditions')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Enable">Enable</label>
                                            <div class="form-check">
                                                <input class="form-check-input @error('enable') is-invalid @enderror"
                                                    type="radio" name="enable" value="yes" id="" {{$service !==null &&
                                                    $service->enable == 'yes' ? 'checked': ''}}>
                                                <label class="form-check-label" for="enable">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input @error('enable') is-invalid @enderror"
                                                    type="radio" name="enable" id="" value="no" {{$service !==null &&
                                                    $service->enable == 'no' ? 'checked': ''}}>
                                                <label class="form-check-label" for="enable">
                                                    No
                                                </label>
                                            </div>
                                            @error('enable')
                                            <div class=" invalid-feedback">{{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- SUBMIT-->
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                            <button class="btn btn-success" type="submit"><i
                                                    class="fa fa-save mr-2"></i> Save Changes</button>

                                        </div>
                                        <!-- SUBMIT-->
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--EDIT SERVICES MODAL---->

                    <!-- Delete Service Modal -->
                    <div class="modal fade deleteServiceModal" id="deleteServiceModal-{{$service->id}}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">DELETE SERVICE</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label class="control-label">Do you want to delete this Service</label>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Service Name</label>
                                            <input type="text" name="services" id="" class="form-control"
                                                value="{{$service->services ?? '' }}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Price Type</label>
                                            <input type="text" name="price_type" id="" class="form-control"
                                                value="{{$service->price_type ?? ''}}" disabled>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    <button class="btn btn-secondary">
                                        <a class="text-danger" href="{{route('service.delete', $service->id )}}">
                                            Delete
                                        </a>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Service Modal -->
                    @empty
                    <div class="text-danger">You have not added any Services for this property. Click "Add"
                    </div>
                    @endforelse
                </tbody>

            </table>
            <hr>
            <h3>Additional Fees</h3>
            <table class="additionaal_fees table stripped">
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Price Type</th>
                        <th>Currency</th>
                        <th>Price</th>
                        <th>Price Inclusion</th>
                        <th>Duration</th>
                        <th>Confirmation Required</th>
                        <th>Terms & Conditions</th>
                        <th>Enable</th>

                        <th> <a href="javascript:void(0)" class="btn btn-success btn-sm ml-2" data-toggle="modal"
                                data-target="#additionalfeesModal"><i class="fa fa-plus-circle mr-1"></i></a>
                        </th>



                    </tr>
                </thead>
                <tbody>
                    @forelse ($additional_fees as $additional_fee )

                    <tr id="addid{{$additional_fee->id}}">
                        <td>
                            <p>{{strtoupper($additional_fee->additional_fee ?? '')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($additional_fee->price_type ?? 'none')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($additional_fee->currency ?? 'none')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($additional_fee->price ?? 'none')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($additional_fee->price_inclusion ?? 'none')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($additional_fee->duration ?? 'none')}}</p>

                        </td>
                        <td>
                            <p>{{strtoupper($additional_fee->confirmation_type ?? 'none')}}</p>

                        </td>
                        <td>
                            <a href="javascript:void(0)" data-toggle="modal"
                                data-target="#viewTermsAdditionalModal-{{$additional_fee->id ?? '' }}"><i
                                    class="fa fa-eye text-primary ml-2 mr-1 "></i></a>
                        </td>
                        <td>
                            <p>{{strtoupper($additional_fee->enable ?? 'none')}}</p>
                        </td>

                        <td valign="top">
                            <a href="javascript:void(0)" data-toggle="modal"
                                data-target="#editAdditionalModal-{{$additional_fee->id}}"><i
                                    class="fa fa-edit mr-2 "></i>
                            </a>

                            <a href="javascript:void(0)" data-toggle="modal"
                                data-target="#deleteAdditionalModal-{{$additional_fee->id}}"><i
                                    class="fa fa-trash text-danger "></i>
                            </a>
                        </td>

                    </tr>
                    <!-- View Additional Fees Terms & Conditions Modal -->
                    <div class="modal fade viewTermsAdditionalModal"
                        id="viewTermsAdditionalModal-{{$additional_fee->id ?? '' }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">{{$additional_fee->additional_fee ??
                                        'Additional Fees'}}
                                        -Additional Fees Terms and Conditions</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="Price Type">Terms and Conditions</label>
                                        <textarea class="form-control" name="" disabled>{{$additional_fee->terms_and_conditions ?? 'none'}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- View Additional Fees Terms & Conditions Modal -->
                    <!--EDIT ADDITIONAL FEES MODAL---->
                    <div class="modal fade editAdditionalModal" id="editAdditionalModal-{{$additional_fee->id}}"
                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">EDIT ADDITIONAL FEES</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{route('additional-fees.update')}}">
                                        @csrf
                                        <input type="hidden" name="provider_id" id="provider_id"
                                            value="{{Auth::user()->provider_id}}">
                                        <input type="hidden" name="property_id" id="property_id"
                                            value="{{$property->id ?? '' }}">
                                        <input type="hidden" name="id" id="id" value="{{$additional_fee->id}}">
                                        <input type="hidden" name="additional_fee"
                                            value="{{$additional_fee->additional_fee ?? ''}}">
                                        <div class="form-group">
                                            <label for="">Additional Fee Name</label>
                                            <input type="text"
                                                class="form-control @error('additional_fee') is-invalid @enderror"
                                                placeholder="" name=""
                                                value="{{$additional_fee->additional_fee ?? '' }}" disabled />
                                            @error('additional_fee')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Type">Price Type</label>
                                            <select name="price_type" id="price-type4"
                                                class="form-control @error('price_type') is-invalid @enderror"
                                                value="{{$additional_fee->price_type ?? '' }}">
                                                <option value='{{$additional_fee !==null && $additional_fee->price_type !== null ?
                                                    $additional_fee->price_type :""}}' selected>
                                                    {{$additional_fee !== null && $additional_fee->price_type
                                                    !== null ? $additional_fee->price_type :"Select Price
                                                    Type"}}
                                                </option>
                                                <option value="free">FREE</option>
                                                <option value="per guest">Per Guest</option>
                                                <option value="per adult">Per Adult</option>
                                                <option value="per child">Per Child</option>
                                                <option value="per session">Per Session</option>
                                                <option value="per day">Per Day</option>
                                                <option value="per stay">Per Stay</option>
                                            </select>
                                            @error('price_type')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Currency">Price Currency</label>
                                            <select name="currency" id=""
                                                class="form-control @error('currency') is-invalid @enderror"
                                                value="{{$additional_fee->currency}}">
                                                <option value='{{$additional_fee !==null && $additional_fee->currency !== null ?
                                                    $additional_fee->currency :""}}' selected>
                                                    {{$additional_fee !== null &&
                                                    $additional_fee->currency !== null ?
                                                    $additional_fee->currency :" Select Currency"}}
                                                </option>
                                                <option value="USD">USD</option>
                                                <option value="KES">KES</option>
                                            </select>
                                            @error('currency')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Value">Price Value</label>
                                            <input type="number" name="price" id="price-value4"
                                                class="form-control @error('price') is-invalid @enderror"
                                                placeholder="Price" value="{{$additional_fee->price ?? '' }}">
                                            @error('price')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Inclusion">Price Inclusion</label>
                                            <select name="price_inclusion" id=""
                                                class="form-control @error('') is-invalid @enderror"
                                                value="{{$additional_fee->price_inclusion ?? '' }}">
                                                <option value='{{$additional_fee !==null && $additional_fee->price_inclusion !== null ?
                                                    $additional_fee->price_inclusion :""}}' selected>
                                                    {{$additional_fee !== null && $additional_fee->price_inclusion
                                                    !== null ? ucwords($additional_fee->price_inclusion) :"Select Price
                                                    Type"}}
                                                </option>
                                                <option value="included">Included</option>
                                                <option value="not included">Not Included</option>
                                            </select>
                                            @error('price_inclusion')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="duration">Duration</label>
                                            <div class="form-group">
                                                <input type="text" name="duration"
                                                    class="form-control @error('duration') is-invalid @enderror"
                                                    value="{{$additional_fee->duration ?? ''}}" />
                                            </div>
                                            @error('duration')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="Price Type">Confirmation Required</label>
                                            <select name="confirmation_type" id=""
                                                class="form-control @error('confirmation_type') is-invalid @enderror"
                                                value="{{$additional_fee->confirmation_type}}">
                                                <option value='{{$additional_fee !==null && $additional_fee->confirmation_type !== null ?
                                                    $additional_fee->confirmation_type :""}}' selected>
                                                    {{$additional_fee !== null &&
                                                    $additional_fee->confirmation_type !== null ?
                                                    $additional_fee->confirmation_type :" Select
                                                    Confirmation Type"}}
                                                </option>
                                                <option value="per guest">Per Guest</option>
                                                <option value="per session">Per Session</option>
                                                <option value="per day">Per Day</option>
                                                <option value="per stay">Per Stay</option>
                                            </select>
                                            @error('confirmation_type')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Type">Terms and Conditions</label>
                                            <textarea
                                                class="form-control  @error('terms_and_conditions') is-invalid @enderror"
                                                name="terms_and_conditions"
                                                value="{{$additional_fee->terms_and_conditions ?? ''}}">{{$additional_fee->terms_and_conditions ?? ''}}</textarea>
                                            @error('terms_and_conditions')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Price Type">Enable</label>
                                            <div class="form-check">
                                                <input class="form-check-input @error('enable') is-invalid @enderror"
                                                    type="radio" name="enable" value="yes" id="" {{$additional_fee
                                                    !==null && $additional_fee->enable ==
                                                'yes' ? 'checked': ''}}>
                                                <label class="form-check-label" for="additional_fees_status">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input @error('enable') is-invalid @enderror"
                                                    type="radio" name="enable" id="" value="no" {{$additional_fee
                                                    !==null && $additional_fee->enable == 'no'
                                                ? 'checked': ''}}>
                                                <label class="form-check-label" for="additional_fees_status">
                                                    No
                                                </label>
                                            </div>
                                            @error('enable')
                                            <div class=" invalid-feedback">{{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- SUBMIT-->
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                            <button class="btn btn-success" type="submit"><i
                                                    class="fa fa-save mr-2"></i> Save Changes</button>

                                        </div>
                                        <!-- SUBMIT-->
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--EDIT ADDITIONAL FEES MODAL---->

                    <!-- Delete Additional Fees Modal -->
                    <div class="modal fade deleteAdditionalModal" id="deleteAdditionalModal-{{$additional_fee->id}}"
                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">DELETE ADDITIONAL FEES</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label class="control-label">Do you want to delete this Additional Fees </label>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Additional Fees Name</label>
                                            <input type="text" name="additional_fee" id="" class="form-control"
                                                value="{{$additional_fee->additional_fee ?? ''}}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Price Type</label>
                                            <input type="text" name="price_type" id="" class="form-control"
                                                value="{{$additional_fee->price_type ?? ''}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    <button class="btn btn-secondary">
                                        <a class="text-danger"
                                            href="{{route('additional-fees.delete', $additional_fee->id )}}">
                                            Delete
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Additional Modal -->
                    @empty
                    <div class="text-danger">You have not added any Additional Fees for this property. Click "Add"
                    </div>
                    @endforelse
                </tbody>

            </table>
            <hr>
        </div>
        <div class="d-flex justify-content-end p-2">
            <a href="{{route('property-step-eight',$property->id)}}" class="btn btn-success mr-3">Previous</a>
            <a href="{{route('property-step-ten',$property->id)}}" class="btn btn-success">Next</a>
        </div>

    </div>
    @include('modals.add-property.facilities')
    @include('modals.add-property.amenities')
    @include('modals.add-property.services')
    @include('modals.add-property.additional-fees')



</div>
<!-- Edit Modal -->
<div class="modal fade editfacModal" id="editfacModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Edit Facility</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form id="" action="{{route('fac.update')}}" method="POST">
                    @csrf
                    <div class="container-fluid">

                        <input type="hidden" name="id" id="fac_id">
                        <input type="hidden" name="facility" id="facility">
                        <div class="container-fluid">

                            <div class="form-group">
                                <label for="">Facility Name</label>
                                <input type="text" name="" id="fac" class="form-control" placeholder="Facility Name"
                                    value="" disabled>
                            </div>

                            <div class="form-group">
                                <label for="">Price Type</label>
                                <select name="price_type" id="price_type" class="form-control">
                                    <option value="">Select Price Type</option>
                                    <option value="free">FREE</option>
                                    <option value="per guest">Per Guest</option>
                                    <option value="per adult">Per Adult</option>
                                    <option value="per child">Per Child</option>
                                    <option value="per session">Per Session</option>
                                    <option value="per day">Per Day</option>
                                    <option value="per stay">Per Stay</option>

                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">Currency</label>
                                <select name="currency" id="currency" class="form-control">
                                    <option value="">Select Currency</option>
                                    <option value="usd">USD</option>
                                    <option value="kes">KES</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" name="price" id="price" class="form-control" placeholder="Price">
                            </div>
                            <div class="form-group">
                                <label for="">Duration</label>
                                <input type="text" name="duration" id="duration" class="form-control"
                                    placeholder="Duration">
                            </div>
                            <div class="form-group">
                                <label for="">Confirmation Required</label>
                                <select name="confirmation_type" id="confirmation_type" class="form-control">
                                    <option value="per guest">Per Guest</option>
                                    <option value="per session">Per Session</option>
                                    <option value="per day">Per Day</option>
                                    <option value="per stay">Per Stay</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Terms & Conditions</label>
                                <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-control"
                                    placeholder="T&C"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Enabled</label>
                                <select name="enable" id="enable" class="form-control">

                                    <option value="yes">YES</option>
                                    <option value="no">NO</option>
                                </select>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button class="btn btn-success" type="submit"><i class="fa fa-save mr-2"></i> Save
                            Changes</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    function editFacility(id){
var get_fac = '{{ route("fac.get", ":id") }}';
get_fac = get_fac.replace(':id',id)

$.ajax({

    url: get_fac,
  type: 'GET',
  data: {
    _token: $("input[name=_token]").val(),
  },
  success: function (fac) {

    $("#fac_id").val(fac.id);
    $("#facility").val(fac.facility);
    $("#fac").val(fac.facility);
    $("#price_type").val(fac.price_type);
    $("#currency").val(fac.currency);
    $("#price").val(fac.price);
    $("#duration").val(fac.duration);
    $("#confirmation_type").val(fac.confirmation_type);
    $("#terms_and_conditions").val(fac.terms_and_conditions);
    $("#enable").val(fac.enable);

    $("#editfacModal").modal('toggle');
  }
            })
 }

    function deleteFacility(id){

    if(confirm("Do yo want to delete this facility?")){
        var fac_to_delete = '{{ route("fac.get", ":id") }}';
        fac_to_delete = fac_to_delete.replace(':id',id)
        $.ajax({

            url:fac_to_delete,
            type:'POST',
            data:{
                _token : $("input[name=_token]").val(),
            },
            success:function(response){

                $("#facid"+id).remove();
            }

    });

    }
    }
</script>
@endsection