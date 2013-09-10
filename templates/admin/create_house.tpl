<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Добавить дом</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/cp/map/street_houses/{$street_id}" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                    <button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#createForm" data-submit><i class="icon-plus-sign icon-white"></i>{lang('a_create')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#createForm" data-action="tomain"><i class="icon-ok"></i>{lang('a_save_and_exit')}</button>
                </div>
            </div>                            
        </div>
        <form action="{$BASE_URL}admin/components/cp/map/create_house/{$street_id}" id="createForm" method="post">
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
                                            <label class="control-label" for="city_name">Номер дома:</label>
                                            <div class="controls">
                                                <input type="text" class="textbox" name="house_number" id="house_number" required/>
												<input type="hidden" name="street_id" id="street_id" value="{$street_id}" />
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
    </section>
</div>