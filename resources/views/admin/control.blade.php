<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
        </div>
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <h3 class="control-sidebar-heading">General Settings</h3>
            {!! Form::open([
                'role' => 'form',
                'url' => action('AdminController@saveSettings'),
                'method' => 'POST'
            ]) !!}
            <div class="form-group">
                <label class="control-sidebar-subheading">
                    Email
                    <input type="text" name="email" class="email" value="{{ App\Helpers\Helpers::getSetting('email') }}">
                </label>
            </div>
            <div class="form-group">
                <label class="control-sidebar-subheading">
                    Price per question
                    <input type="number" name="question_price" class="pull-right" value="{{ App\Helpers\Helpers::getSetting('question_price') }}">
                </label>
            </div>
            <div class="form-group">
                <label class="control-sidebar-subheading">
                    GROSS consultant
                    <input type="number" name="gross_consultant" class="pull-right" value="{{ App\Helpers\Helpers::getSetting('gross_consultant') }}">
                </label>
            </div>
            <div class="form-group">
                <label class="control-sidebar-subheading">
                    Limited access mode
                    @php($limited_access = App\Helpers\Helpers::getSetting('limited_access'))
                    <div>
                        YES
                        <input type="radio" name="limited_access" {{ $limited_access ? 'checked' : '' }} class="pull-right" value="1">
                    </div>
                    <div>
                        NO
                        <input type="radio" name="limited_access" {{ $limited_access ? '' : 'checked' }} class="pull-right" value="0">
                    </div>
                </label>
            </div>
            <div class="form-group">
                <input type="submit" class="btn-sm btn-success pull-right" value="Save">
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>