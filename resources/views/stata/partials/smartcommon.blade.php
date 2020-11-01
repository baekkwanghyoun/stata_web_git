<div class="pt-6">
    <div class="form-group">
        <label>차수 : 01~21 (필수)</label>

        <select class="form-control select2" id="kt_select2_5" name="kt_select2_5[]" multiple="multiple">
            @for ($i = 1; $i <= 21; $i++)
                <option value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
            @endfor
        </select>
        <span class="form-text text-muted">멀티 선택이 가능합니다.</span>
    </div>
{{--
    <div class="form-group row">
        <label class="col-2 col-form-label">작업폴더 : </label>
        <div class="col-2">
            <input class="form-control" type="text" value="" id="example-text-input"/>
        </div>

        <label class="col-6 col-form-label">웹사이트 (http://로 시작)</label>
        <div class="col-2">
            <input class="form-control" type="text" value="" id="example-text-input"/>
        </div>
    </div>
    --}}
</div>
