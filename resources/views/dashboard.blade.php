@extends('layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    textarea {
        resize: none;
    }

    .card {
        width: 25em;
    }

</style>
@section('content')
<div class="container pt-1 pb-4">
    <div class="container">
        <div class="col-12 d-flex">
            <div class="col-12 ">
                <div class="col-12 ">                       
                    <div class="container d-flex m-1"> 
                        <div class="col-2"></div>    
                        <div class="col-8 bg-white p-1">
                            <h2 class="">Toutes les formations</h2>
                        </div>    
                        <div class="col-2"></div>    
                    </div>
                    <div class="container m-1">
                        <div class="col-12 text-end d-flex">
                            <div class="col-2"></div>
                            <div class="col-8">                                
                            <button type="button" class="btn bg-primary text-light" data-bs-toggle="modal"
                                data-bs-target="#exampleModal2" data-bs-whatever="@fat">+ Créer une formation</button>
                            </div>
                            <div class="col-2"></div>
                        </div>
                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-uppercase" id="exampleModal2Label">formulaire ajout
                                            d'une formation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('dashboard-post')}}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="class_name" class="col-form-label">Nom de la
                                                    Formation</label>
                                                <input type="text" class="form-control" id="class_name"
                                                    name="class_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="adviser_id" class="col-form-label">Nom du conseiller</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    id="adviser_id" name="adviser_id" required>
                                                    @foreach($advisers as $adviser)
                                                    <option value="{{ $adviser->id }}">{{ $adviser->last_name }}
                                                        {{ $adviser->first_name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->first('adviser_id'))
                                                <div class="alert-danger">{{$errors->first('adviser_id')}}</div>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="job_id" class="col-form-label">Nom du job:</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    id="job_id" name="job_id" required>
                                                    @foreach($Post as $Posts)
                                                    <option value="{{ $Posts->id }}">{{ $Posts->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="col-form-label">Description de la
                                                    classe:</label>
                                                <textarea class="form-control " id="description" name="description"
                                                    rows="3" required></textarea>
                                                @if($errors->first('description'))
                                                <div class="alert-danger">{{$errors->first('description')}}</div>
                                                @endif
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit"
                                                    class="btn btn-primary text-light">Envoyer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div>
        <div class="container">
            @if(session()->has('success'))
            <div class="container d-flex mt-3">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="alert alert-success text-center alertDismissible">
                        <strong>
                            {{session()->get('success')}}
                        </strong>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            @endif
            @if(session()->has('danger'))
            <div class="container d-flex mt-3">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="alert alert-danger text-center alertDismissible">
                        <strong>
                            {{session()->get('danger')}}
                        </strong>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            @endif
        </div>
        <div class="container d-flex">
            <div class="col-2"></div>
            <div class="col-8">
                <table class="table table-bordered w-100 ">
                    <thead class="bg-giep text-white w-100 ">
                        <tr class=" d-lg-table-row text-light bg-dark align-middle">
                            <th>Formation</th>
                            <th>Nombre d'apprenant</th>
                            <th>Nombre à avoir trouvé</th>
                            <th>En l'attente d'une réponse</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($Sections->count()>0)
                        @foreach($Sections as $Section)
                        <tr>
                            <td class="text-capitalize">{{$Section->class_name }} </td>
                            <td class="text-capitalize">{{$Section->students->count() }}</td>
                            <td>{{$Section->students->where('followUps->status','oui')->count() }}</td>
                            <td>{{$Section->students->where('followUps->status','oui')->count() }}</td>
                            <td>
                                <a href="{{ route('dashboard-formation', $Section->id)}}">
                                    <button type="button" class="btn btn-primary text-light">Voir</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="9" class="table-active text-center">Aucunes Formation disponible </td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                {{ $Sections->links()}}
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(".alertDismissible").fadeTo(2000, 500).slideUp(500, function () {
                $(".alertDismissible").slideUp(600);
            });
        })

    </script>
    @endsection
