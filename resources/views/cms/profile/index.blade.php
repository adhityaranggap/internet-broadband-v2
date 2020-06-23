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
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Site Title</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" name="site_title" class="form-control" id="site-title">
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label for="site-description" class="form-control-label col-sm-3 text-md-right">Site Description</label>
                        <div class="col-sm-6 col-md-9">
                          <textarea class="form-control" name="site_description" id="site-description"></textarea>
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label class="form-control-label col-sm-3 text-md-right">Site Logo</label>
                        <div class="col-sm-6 col-md-9">
                          <div class="custom-file">
                            <input type="file" name="site_logo" class="custom-file-input" id="site-logo">
                            <label class="custom-file-label">Choose File</label>
                          </div>
                          <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label class="form-control-label col-sm-3 text-md-right">Favicon</label>
                        <div class="col-sm-6 col-md-9">
                          <div class="custom-file">
                            <input type="file" name="site_favicon" class="custom-file-input" id="site-favicon">
                            <label class="custom-file-label">Choose File</label>
                          </div>
                          <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="form-control-label col-sm-3 mt-3 text-md-right">Google Analytics Code</label>
                        <div class="col-sm-6 col-md-9">
                          <textarea class="form-control codeeditor" name="google_analytics_code" style="display: none;"></textarea><div class="CodeMirror cm-s-duotone-dark" style="width: 100%; height: 200px;"><div style="overflow: hidden; position: relative; width: 3px; height: 0px; top: 4px; left: 33px;"><textarea autocorrect="off" autocapitalize="off" spellcheck="false" style="position: absolute; bottom: -1em; padding: 0px; width: 1000px; height: 1em; outline: none;" tabindex="0"></textarea></div><div class="CodeMirror-vscrollbar" cm-not-content="true" style="width: 18px; pointer-events: none;"><div style="min-width: 1px; height: 0px;"></div></div><div class="CodeMirror-hscrollbar" cm-not-content="true" style="height: 18px; pointer-events: none;"><div style="height: 100%; min-height: 1px; width: 0px;"></div></div><div class="CodeMirror-scrollbar-filler" cm-not-content="true"></div><div class="CodeMirror-gutter-filler" cm-not-content="true"></div><div class="CodeMirror-scroll" tabindex="-1"><div class="CodeMirror-sizer" style="margin-left: 29px; margin-bottom: 0px; border-right-width: 30px; min-height: 29px; min-width: 7px; padding-right: 0px; padding-bottom: 0px;"><div style="position: relative; top: 0px;"><div class="CodeMirror-lines" role="presentation"><div role="presentation" style="position: relative; outline: none;"><div class="CodeMirror-measure"><span><span>​</span>x</span></div><div class="CodeMirror-measure"></div><div style="position: relative; z-index: 1;"></div><div class="CodeMirror-cursors"><div class="CodeMirror-cursor" style="left: 4px; top: 0px; height: 21px;">&nbsp;</div></div><div class="CodeMirror-code" role="presentation"><div style="position: relative;"><div class="CodeMirror-gutter-wrapper" style="left: -29px;"><div class="CodeMirror-linenumber CodeMirror-gutter-elt" style="left: 0px; width: 21px;">1</div></div><pre class=" CodeMirror-line " role="presentation"><span role="presentation" style="padding-right: 0.1px;"><span cm-text="">​</span></span></pre></div></div></div></div></div></div><div style="position: absolute; height: 30px; width: 1px; border-bottom: 0px solid transparent; top: 29px;"></div><div class="CodeMirror-gutters" style="height: 59px;"><div class="CodeMirror-gutter CodeMirror-linenumbers" style="width: 29px;"></div></div></div></div>
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