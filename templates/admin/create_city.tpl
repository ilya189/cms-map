<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Добавить населенный пункт</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/cp/map" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                    <button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#createForm" data-submit><i class="icon-plus-sign icon-white"></i>{lang('a_create')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#createForm" data-action="tomain"><i class="icon-ok"></i>{lang('a_save_and_exit')}</button>
                </div>
            </div>                            
        </div>
        <form action="{$BASE_URL}admin/components/cp/map/create_city" id="createForm" method="post">
            <div class="content_big_td">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('a_sett')}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span9">
                                    <div class="form-horizontal">
                                        <div class="control-group">
                                            <label class="control-label" for="city_name">Название:</label>
                                            <div class="controls">
                                                <input type="text" class="textbox" name="city_name" id="city_name" required/>
                                            </div>
                                        </div>
										<div class="control-group">
                                            <label class="control-label" for="city_lat">Широта(lat):</label>
                                            <div class="controls">
                                                <input type="text" class="textbox" name="city_lat" id="city_lat" required/>
                                            </div>
                                        </div>
										<div class="control-group">
                                            <label class="control-label" for="city_lng">Долгота(lng):</label>
                                            <div class="controls">
                                                <input type="text" class="textbox" name="city_lng" id="city_lng" required/>
                                            </div>
                                        </div>
										<div class="control-group">
                                            <label class="control-label" for="city_zoom">Зум(zoom):</label>
                                            <div class="controls">
                                                <input type="text" class="textbox" name="city_zoom" id="city_zoom" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {form_csrf()} 
        </form>
		<button id="map-bd" style="display:none;" onClick="loadmap.getdata('city')" class="btn btn-small btn-primary">Загрузить данные</button>
		<button id="map-bi" onClick="loadmap.initialize('city')" class="btn btn-small btn-primary">Загрузить карту</button>
		<br /><br />
		<div id="map"></div>
    </section>
</div>