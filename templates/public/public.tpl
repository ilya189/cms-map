<label for="city">Населенный пункт: </label>
<select id="city" name="city">
{foreach $cities as $city}
	<option value="{$city.id}">{$city.city}</option>
{/foreach}
</select>

<span style="padding:0 10px;"></span>
<label for="street">Улица: </label>
<input id="street" value="" />
<input id="street_id" type="hidden" value="" />

<span style="padding:0 10px;"></span>
<label for="house">Дом: </label>
<input id="house" value="" />
<input id="house_id" type="hidden" value="" />


