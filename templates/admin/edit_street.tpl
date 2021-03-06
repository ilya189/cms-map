
<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Редактировать улицу - {$street}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/cp/map/city_streets/{$city_id}" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                    <!--<button type="submit" class="btn btn-small action_on saveButton"  idMenu="{$id}"><i class="icon-ok"></i>Сохранить</button>-->
                    <button type="submit" class="btn btn-small btn-primary action_on formSubmit"  data-form="#saveForm" data-submit><i class="icon-ok"></i>{lang('a_save')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#saveForm" data-action="tomain"><i class="icon-check"></i>Сохранить и выйти</button>
                </div>
            </div>                            
        </div>
        <form action="/admin/components/cp/map/update_street/{$id}" method="POST"  id="saveForm">
            <div class="tab-content">
                <div class="tab-pane active" id="modules">

                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang('amt_edit_menu')}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd span9">
                                        <div class="form-horizontal">
                                            <div class="control-group m-t_10">
                                                <label class="control-label" for="inputParent">{lang('amt_name')}:</label>
                                                <div class="controls">
                                                    <input type="text" name="street_name" value="{$street}" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="street_lat">Широта(lat):</label>
                                                <div class="controls">
                                                    <input type="text" class="textbox" name="street_lat" id="draw-lat" value="{$lat}" required />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="street_lng">Долгота(lng):</label>
                                                <div class="controls">
                                                    <input type="text" class="textbox" name="street_lng" id="draw-lng" value="{$lng}" required />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="street_zoom">Зум(zoom):</label>
                                                <div class="controls">
                                                    <input type="text" class="textbox" name="street_zoom" id="draw-zoom" value="{$zoom}" required />
                                                </div>
                                            </div>
                                            <div id="draw-elements">
                                                {foreach $elements as $key => $element}
                                                    {foreach $element as $position}
                                                        <div class="control-group">
                                                            <label class="control-label" for="{$key}">{$key}:</label>
                                                            <div class="controls">
                                                                <input type="text" class="textbox {$key}" name="{$key}[]" value='{$position}' required />
                                                            </div>
                                                        </div>
                                                    {/foreach}
                                                {/foreach}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {form_csrf()}
        </form>
        <button id="map-bd" style="display:none;" onClick="loadmap.getdata('street');" class="btn btn-small btn-primary">Загрузить данные</button>
        <button id="map-bi" onClick="loadmap.initialize('street');" class="btn btn-small btn-primary">Загрузить карту</button>
        <br /><br />
        <div id="map"></div>
    </section>
</div>
