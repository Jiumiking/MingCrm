<label>
    <select name="paginate" aria-controls="demo-dt-selection" class="form-control input-sm">
        <option value="10" @if (app('request')->get('paginate') == '10' ) selected="selected" @endif>10</option>
        <option value="25" @if (app('request')->get('paginate',25) == '25' ) selected="selected" @endif>25</option>
        <option value="50" @if (app('request')->get('paginate') == '50' ) selected="selected" @endif>50</option>
        <option value="100" @if (app('request')->get('paginate') == '100' ) selected="selected" @endif>100</option>
    </select>
</label>