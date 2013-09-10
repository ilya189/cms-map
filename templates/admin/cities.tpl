<div class="container">

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Удаление населенных пунктов</h3>
        </div>
        <div class="modal-body">
            <p>Удалить выбранные населенные пункты?</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/cp/map/delete_city')" >{lang('a_delete')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('a_cancel')}</a>
        </div>
    </div>

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->

    <form id="deleteMenu">
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">Населенные пункты</span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
                        <button type="button" class="btn btn-small btn-success" onclick="window.location.href = '{$BASE_URL}admin/components/cp/map/create_city_tpl'"><i class="icon-plus-sign icon-white"></i>Добавить населенный пункт</button>
                        <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()"><i class="icon-trash icon-white"></i>{lang('a_delete')}</button>
                    </div>
                </div>                            
            </div>
            <div class="tab-content">
                <div class="row-fluid">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox"/>
                                        </span>
                                    </span>
                                </th>
                                <th class="span1">{lang('amt_id')}</th>
                                <th class="span3">Населенный пункт</th>
								<th class="span2">Координаты</th>
                                <th class="span2">{lang('amt_crea')}</th>
                                <th class="span2">{lang('a_edit')}</th>
                            </tr>
                        </thead>
                        <tbody >
                            {if count($cities) > 0}
                                {foreach $cities as $city}
                                    <tr class="simple_tr">
                                        <td class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n" >
                                                    <input type="checkbox" name="ids" value="{$city.id}"/>
                                                </span>
                                            </span>
                                        </td>
                                        <td ><p>{$city.id}</p></td>
                                        <td>
                                            <a class="pjax" href="{$SELF_URL}/city_streets/{$city.id}" id="del" >{$city.city}</a>
                                        </td>
										<td>[{$city.lat}],[{$city.lng}],[{$city.zoom}]</td>
                                        <td>{date('Y-d-m H:i', $city.created)}</td>
                                        <td><a href="{$BASE_URL}admin/components/cp/map/edit_city/{$city.id}" class="pjax">{lang('a_edit')}</a></td>
                                    </tr>
                                {/foreach}
                            {/if}
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </form>
</div>
