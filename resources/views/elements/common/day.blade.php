
{{-- デフォルト値がなければ初期化 --}}
@if( !isset( $name ) == True )
	@php
	$name = null;
	@endphp
@endif

{{-- デフォルト値がなければ初期化 --}}
@if( !isset( $value ) == True )
	@php
	$value = null;
	@endphp
@endif

{{-- デフォルト値がなければ初期化 --}}
@if( !isset( $setting ) == True )
	@php
	$setting = [];
	@endphp
@endif

{{-- optionsはviewcomposerで指定 --}}
{!! Form::select( $name, $options, $value, $setting ) !!}
