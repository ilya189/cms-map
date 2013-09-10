<div class="container">

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Удаление домов</h3>
        </div>
        <div class="modal-body">
            <p>Удалить выбранные дома?</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/cp/map/delete_house')" >{lang('a_delete')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('a_cancel')}</a>
        </div>
    </div>

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <form id="deleteMenu">
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">
						<a href="/admin/components/cp/map">Населенные пункты</a>&rarr;
						<a href="/admin/components/cp/map/city_streets/{$insert_city.id}">{$insert_city.city}</a>&rarr;
						{$insert_street.street}
					</span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
						<a href="/admin/components/cp/map/city_streets/{$insert_city.id}" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                        <button type="button" class="btn btn-small btn-success" onclick="window.location.href = '{$BASE_URL}admin/components/cp/map/create_house_tpl/{$insert_street.id}'"><i class="icon-plus-sign icon-white"></i>Добавить дом</button>
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
                                <th class="span3">Дом</th>
                                <th class="span2">{lang('amt_crea')}</th>
                                <th class="span2">{lang('a_edit')}</th>
                            </tr>
                        </thead>
                        <tbody >
                            {if count($houses) > 0}
                                {foreach $houses as $house}
                                    <tr class="simple_tr">
                                        <td class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n" >
                                                    <input type="checkbox" name="ids" value="{$house.id}"/>
                                                </span>
                                            </span>
                                        </td>
                                        <td ><p>{$house.id}</p></td>
                                        <td>
                                            <p>{$house.house}</p>
                                        </td>
                                        <td>{date('Y-d-m H:i', $house.created)}</td>
                                        <td><a href="{$BASE_URL}admin/components/cp/map/edit_house/{$house.id}" class="pjax">{lang('a_edit')}</a></td>
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