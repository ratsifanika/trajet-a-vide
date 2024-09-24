<select name="car_id" id="car_id" class="form-control">
    @foreach($cars as $car)
        <option value="{{ $car->id }}">{{ $car->brand }} - {{ $car->model }}</option>
    @endforeach
</select>