@if(Session::has('success'))
<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" class="close" data-dismiss="alert" type="button">
        ×
    </button>
    <h4>
        <i class="icon fa fa-check">
        </i>
        Success!
    </h4>
    {{ Session::get('success') }}
</div>
<script>
    setTimeout(function(){
        $('#alert').alert('close');
}, 2500);//wait 2 seconds
</script>
@endif
@if(Session::has('danger'))
<div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" class="close" data-dismiss="alert" type="button">
        ×
    </button>
    <h4>
        <i class="icon fa fa-close">
        </i>
        Error!
    </h4>
    {{ Session::get('danger') }}
</div>
<script>
    setTimeout(function(){
        $('#alert').alert('close');
}, 2500);//wait 2 seconds
</script>
@endif
@if(Session::has('warning'))

<div class="alert alert-warning alert-dismissable">
    <button aria-hidden="true" class="close" id="alert" data-dismiss="alert" type="button">
        ×
    </button>
    <h4>
        <i class="icon fa fa-close">
        </i>
        Warning!
    </h4>
    {{ Session::get('warning') }}
</div>
<script>
    setTimeout(function(){
        $('#alert').alert('close');
}, 2500);//wait 2 seconds
</script>
@endif
@if (count($errors) > 0)
<div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" class="close" data-dismiss="alert" type="button">
        ×
    </button>
    @foreach ($errors->all() as $error)
        {{ $error }}
    <br/>
    @endforeach
</div>
@endif
