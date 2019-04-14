@extends('layouts.limitless.main')
@section('content-admin')
<?php
$title_m = '';$caption_m = '';$url_m = '';$link_m ='';
$check;
$lengthkey_ = 0;$lengthmedia = 0;
if(!empty($identify)){
  $title = $identify->title;
  $description = $identify->description;
  $keydata = json_decode($identify->keydata,true);
  $media = json_decode($identify->media,true);
  if(isset($keydata)){
    $lengthkey_ = count($keydata);
    $encode_key = json_decode(json_encode($keydata));
  }
  if(isset($media)){
    $lengthmedia = count($media);
  }
}
//print_r($key_);
$url_service = ($layers->tipelayer == 'dynamic' ? $layers->layerurl.'/'.$idx : $layers->layerurl);
?>
<div class="card card-default">
  <div class="card-header"><h4 class="card-title">{{ $judul }}</h4></div>
  <div class="card-body"> 
      <div class="row">
      <div class="col-sm-12">
      <form method="post" enctype="multipart/form-data" role="form" accept-charset="UTF-8">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <div class="form-group">
          <label for="layerurl">Judul</label>
          <input type="hidden" class="form-control" disabled="disabled" id="layerurl" value="{{ $url_service }}" />
          <input type="text" name="title" value="{{ $title }}" class="form-control" />
          <input type="hidden" name="layerid" class="form-control" value="{{ $idx }}" />
          <input type="hidden" name="layername" class="form-control" value="{{ $layers->kodelayer }}" />
        </div>
        <div class="form-group">
            <label for="display">Display</label>
            <select name="display" class="form-control" id="display-keyvalue" required>
              <option value="-">---</option>
              <option value="keyvalue" @if($identify->display == 'keyvalue') selected @endif>Key Value</option>
              <option value="custom" @if($identify->display == 'custom') selected @endif>Custom</option>
              
            </select>
        </div>
        <div class="form-group" id="deskripsi">
            <label for="description">Deskripsi</label>
            
            <textarea id="description" name="description" class="form-control">{{ $description }}</textarea>
        </div>
        <div class="form-group" id="field-list">
            <label for="title">Field</label>
            <div id="dif">
                
            </div>

            <table class="table table-bordered">
              <tr>
                <th class="check-all"><input type="checkbox" name="checkall" id="checkall"  /></th>
                <th>Nama</th>
                <th>Alias</th>
                <th>Tipe</th>
              </tr>
              @if($lengthkey_ > 0)
                  @foreach($field->fields as $key => $a)
                    <?php $b = ($layers->tipelayer == 'dynamic' ? $a->name : $a->name); ?>
                    @php $c = ($encode_key[$key]->fieldName == $b ? $encode_key[$key]->label:$b) @endphp
                    @php $tipefield = $encode_key[$key]->fieldType; @endphp
                  <tr>
                    <td><input @if($encode_key[$key]->visible) checked @endif type="checkbox" class="checkbox" name="visible[{{ $key }}]" value="{{ $b }}" /></td>
                    <td>{{ $a->name }}<input type="hidden" name="name_field[]" value="{{ $b }}"></td>
                    <td><input type="text" class="form-control" name="label_field[]" value="{{ $c }}"></td>
                    <td><select class="form-control" name="type_field[]">
                          <option @if($tipefield=='text') selected="selected" @endif value="text">Text</option>
                          <option @if($tipefield=='image') selected="selected" @endif value="image">Image</option>
                          <option @if($tipefield=='video') selected="selected" @endif value="video">Video</option>
                          </select>
                        </td>
                  </tr>
                  @endforeach
              @else
                  @foreach($field->fields as $key => $a)
                  <?php $b = ($layers->tipelayer == 'dynamic' ? $a->name : $a->name); ?>
                  <tr>
                    <td><input type="checkbox" class="checkbox" name="visible[{{ $key }}]" value="{{ $b }}" /></td>
                    <td>{{ $a->name }}<input type="hidden" name="name_field[]" value="{{ $b }}"></td>
                    <td><input type="text" class="form-control" name="label_field[]" value="{{ $b }}"></td>
                    <td><select class="form-control" name="type_field[]">
                      <option value="text">Text</option>
                      <option value="image">Image</option>
                      <option value="video">Video</option>
                      </select>
                    </td>
                  </tr>
                  @endforeach
              @endif

            </table>
        </div>
        <!-- Media -->
        @if($lengthmedia > 0)
          @foreach($media as $key => $vm)
            <?php $title_m = $vm['title'] ?>
            <?php $caption_m = $vm['caption'] ?>
            @if($vm['type'] == 'image')
            <?php $url_m = $vm['value']['sourceURL'] ?>
            <?php $link_m = $vm['value']['linkURL'] ?>
            @endif
          <div class="form-group">
            <label>Type</label>
            <select name="type_m" class="form-control" id="type_m">
              <option value="image" @if($vm['type'] == 'image') selected="selected" @endif>Image</option>
              <option value="barchart" @if($vm['type'] == 'barchart') selected="selected" @endif>Bar Chart</option>
              <option value="columnchart" @if($vm['type'] == 'columnchart') selected="selected" @endif>Column Chart</option>
              <option value="linechart" @if($vm['type'] == 'linechart') selected="selected" @endif>Line Chart</option>
              <option value="piechart" @if($vm['type'] == 'piechart') selected="selected" @endif>Pie Chart</option>            
            </select>
            <input type="text" name="title_m" placeholder="Judul" class="form-control cols-sm-2" id="media" value="{{ $vm['title'] }}">
            <input type="text" name="caption_m" placeholder="Caption" class="form-control" id="media" value="{{ $caption_m }}">
            <input type="text" name="link_m" placeholder="Link URL" class="form-control" id="media" value="{{ $link_m }}">
            <input type="text" name="url_m" placeholder="Source URL" class="form-control" id="media" value="{{ $url_m }}">
          </div>
          <div class="form-group" id="media-list">
            <label for="title">Media</label>
            <div id="dim"></div>
              <table class="table table-bordered">
                <tr>
                  <th><input type="checkbox" name="checkall-field" id="checkall-field" class="check-all" /></th>
                  <th>Nama</th>
                  <th>Alias</th>
                </tr>
                @foreach($field->fields as $key => $a)
                <?php $vg=$layers->tipelayer = 'dynamic' ? $a->name : $a->name; ?>
                <tr>
                  <td><input type="checkbox" class="checkbox-field" name="field[{{ $key }}]" value="{{ $vg }}" /></td>
                  <td>{{ $a->name }}</td>
                  <td>{{ $a->name }}</td>
                </tr>
                @endforeach
                
              </table>
          </div>
          @endforeach
        @else
          <div class="form-group">
              <label>Media</label>
              <input type="checkbox" name="mediaonoff" value="1">
          </div>
          <div class="form-group">
            <label>Type</label>
            <select name="type_m" class="form-control" id="type_m">
              <option value="image">Image</option>
              <option value="barchart">Bar Chart</option>
              <option value="columnchart">Column Chart</option>
              <option value="linechart">Line Chart</option>
              <option value="piechart">Pie Chart</option>
            </select>
            <input type="text" name="title_m" placeholder="Judul" class="form-control cols-sm-2" id="media" value="{{ $title_m }}">
            <input type="text" name="caption_m" placeholder="Caption" class="form-control" id="media" value="{{ $caption_m }}">
            <input type="text" name="link_m" placeholder="Link URL" class="form-control" id="media" value="{{ $link_m }}">
            <input type="text" name="url_m" placeholder="Source URL" class="form-control" id="media" value="{{ $url_m }}">
          </div>

          <div class="form-group" id="media-list">
            <label for="title">Media</label>
            <div id="dim"></div>
              <table class="table table-bordered">
                <tr>
                  <th><input type="checkbox" name="checkall-field" id="checkall-field" class="check-all" /></th>
                  <th>Nama</th>
                  <th>Alias</th>
                </tr>
                @foreach($field->fields as $key => $a)
                <?php $vg=$layers->tipelayer = 'dynamic' ? $a->name : $a->name; ?>
                <tr>
                  <td><input type="checkbox" class="checkbox-field" name="field[{{ $key }}]" value="{{ $vg }}" /></td>
                  <td>{{ $a->name }}</td>
                  <td>{{ $a->name }}</td>
                </tr>
                @endforeach
              </table>
          </div>
        @endif

        

        <div class="form-group">
            <label for="showattachments">Show Attachments</label>
            
            <input type="radio" name="showattachments" value="true" @if($identify->showattachments == true) checked="checked" @endif> Yes
            <input type="radio" name="showattachments" value="false" @if($identify->showattachments == false) checked="checked" @endif> No
            
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-sm" name="button" value="Submit">  
        </div>
      </form>
      </div>
      </div>
     
      
  </div>
</div>
@stop

@section('script-end')
@parent
<script type="text/javascript" src="{{ url('js/rm.js')}}"></script>
@endsection