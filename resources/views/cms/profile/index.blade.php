@extends('_layout.app')
@section('title', 'User Profile')
@section('page_header', 'Profile')
@section('content')

    <div class="card card-primary">
          <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Jump To</h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item"><a href="#" class="nav-link active">General</a></li>
                      <li class="nav-item"><a href="#" class="nav-link">Password</a></li>
                      <li class="nav-item"><a href="#" class="nav-link">Profile Picture</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <form id="setting-form">
                  <div class="card" id="settings-card">
                    <div class="card-header">
                      <h4>General Settings</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">General settings such as, site title, site description, address and so on.</p>
                      <div class="form-group row align-items-center">
                        <label for="username" class="form-control-label col-sm-3 text-md-right">Username</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" value="{{ $user->username }}" name="username" class="form-control" id="username">
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="name" class="form-control-label col-sm-3 text-md-right">name</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" value="{{ $user->name }}" name="name" class="form-control" id="name">
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="email" class="form-control-label col-sm-3 text-md-right">email</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="email" value="{{ $user->email }}" name="email" class="form-control" id="email">
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="contact_person" class="form-control-label col-sm-3 text-md-right">Contact person</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="contact_person" value="{{ $user->contact_person }}" name="contact_person" class="form-control" id="contact_person">
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="address" class="form-control-label col-sm-3 text-md-right">Address</label>
                        <div class="col-sm-6 col-md-9">
                          <textarea class="form-control" value="{{ $user->address }}" name="address" id="address"></textarea>
                        </div>
                      </div>
                     
                       
                     
                    </div>
                    <div class="card-footer bg-whitesmoke text-md-right">
                      <button class="btn btn-primary" id="save-btn">Save Changes</button>
                      <button class="btn btn-secondary" type="button">Reset</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>

@endsection