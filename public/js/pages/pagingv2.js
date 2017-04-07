
    function AdpadPaging(ppaging)
    {
        /*
        var ppaging = {
            "frm": "userslist",
            "filter_by": "",
            "search": "",
            "per_page": 10,
            "current_page": 1,
            "total_pages" : 2,
            "order": 'asc',
            "sort_by": 'userid'
        }
        */
        //console.log("========in AdpadPaging======");
        //console.log(ppaging);
		
        this.ppaging = ppaging;
        this.ppaging.debug = ppaging.debug ? ppaging.debug : false;
		this.ppaging.forms = ppaging.forms ? ppaging.forms : []; // use ['form_id'] or [{'type':'search','id':'form_id1'},{'type':'settings','id':'form_id2'}]
        this.ppaging.url = ppaging.url ? ppaging.url : '';
        this.ppaging.frm = ppaging.frm ? ppaging.frm : 'srch';
        this.ppaging.searchid = ppaging.searchid ? ppaging.searchid : 'srch';
        this.ppaging.filter_name = ppaging.filter_name ? ppaging.filter_name : 'filter_name';
        this.ppaging.page_size = ppaging.page_size ? ppaging.page_size : 'page_size';
        this.ppaging.paging_settings = ppaging.paging_settings ? ppaging.paging_settings : 'paging_settings';
        this.ppaging.token = ppaging.token ? ppaging.token : '_token';

        this.ppaging.goto = ppaging.goto ? ppaging.goto : 'goto';
        this.ppaging.static_prefix = ppaging.static_prefix ? ppaging.static_prefix : 'static_prefix';
        this.ppaging.page_num_span = ppaging.page_num_span ? ppaging.page_num_span : 'page_num_span';
        this.ppaging.total_pages_span = ppaging.total_pages_span ? ppaging.total_pages_span : 'total_pages_span';
        this.ppaging.page_range_text = ppaging.page_range_text ? ppaging.page_range_text : 'page_range_text';
        this.ppaging.this_grid = ppaging.this_grid ? ppaging.this_grid : 'this_grid';
        this.ppaging.paging_container_div = ppaging.paging_container_div ? ppaging.paging_container_div : 'paging_container_div';
        this.ppaging.pprev = ppaging.next_button ? ppaging.next_button : 'pprev';  // next button id
        this.ppaging.pnext = ppaging.prev_button ? ppaging.prev_button : 'pnext';  // previous button id
        this.ppaging.refresh_button = ppaging.refresh_button ? ppaging.refresh_button : 'frm_adjustment_ref';
        this.ppaging.on_filter = ppaging.on_filter ? ppaging.on_filter : 'onfilter';
        this.ppaging.post_params = ppaging.post_params ? ppaging.post_params : {'ids' : [] };
        this.ppaging.before_send_callback = (typeof(ppaging.before_send_callback) == 'function') ? ppaging.before_send_callback : function(){

        };
        this.ppaging.complete_callback = (typeof(ppaging.complete_callback) == 'function') ? ppaging.complete_callback : function(){

        };
		this.ppaging.psyncsearch_callback = (typeof(ppaging.psyncsearch_callback) == 'function') ? ppaging.psyncsearch_callback : function(){
			//return "var=value"; or return ""; example output 
			return "";
        };
        this.ppaging.post_init = (typeof(ppaging.post_init) == 'function') ? ppaging.post_init : function(){
            //return "var=value"; or return ""; example output
            return "";
        };


        this.pSubmit = function () {

            if(this.ppaging.url)
            {
                loc = this.ppaging.url;
            }
            else
            {
                var loc = this.pGetStaticPrefixDom().val();
                loc = decodeURIComponent(loc);
            }

            var post = this.pGetPostObject();

            var that = this;

            $.ajax({
                type: 'POST',
                url: loc,
                data: post,
                timeout: 0,
                beforeSend: function() {
                    //toggleSrcLockGrid2();
                    //console.log(that._frmid+'.msg_ok , '+that._frmid+' .msg_error')
                    //$('.msg_ok ,  .msg_error').hide();


                    if(typeof(that.ppaging.before_send_callback) == 'function') that.ppaging.before_send_callback();

                },
                complete: function (data) {
                    //toggleSrcLockGrid2();
                    if(typeof(that.ppaging.complete_callback) == 'function') that.ppaging.complete_callback(data);
                },
                success: function(data) {

                    that.postHandler(data);
                }
            });
           // jQuery.post(loc, post, function (data) {
               // that.postHandler(data);
                /*
                jQuery(this._frmid+' #'+this.ppaging.this_grid).html(data.rows);
                this.pSetPagingObject(data);
                this.pSetDomObjects(data);
                */
            //});

        };

        this.postHandler = function(data) {
            //console.log(data.rows);
			
            jQuery(this._frmid+' #'+this.ppaging.this_grid).html(data.rows);
			
			
            this.pSetPagingObject(data);
            this.pSetDomObjects(data);
            /*
            $(this._frmid+' #this_page').show();
            if(data.total_rows <=0){
                $(this._frmid+' #this_page').hide();
            }
            */
        };

        this.pGetPostObject = function () {
            var post = {};
            for(p in this.ppaging.post_params)
            {

                if(p != 'ids') post[p] = this.ppaging.post_params[p];
            }
            if(this.ppaging.post_params.ids){
                for(var i = 0; i < this.ppaging.post_params.ids.length; i++)
                {
                    var ctrl_id = this.ppaging.post_params.ids[i];
                    if(jQuery('#'+ctrl_id).length)
                    {
                        var param_name = jQuery('#'+ctrl_id).attr('name');
                        var param_value = "";
                        var controlType = jQuery('#'+ctrl_id).attr('type');
                        if(controlType == 'checkbox')
                        {
                            param_value = jQuery('#'+ctrl_id).attr('checked') == 'checked' ? true : false ;
                        }
                        else if(controlType == 'text' || controlType == 'hidden')
                        {
                            param_value = jQuery('#'+ctrl_id).val();
                        }
                        else // assume it is a different HTML element like <span id='cid'>123</span>
                        {
                            param_value = jQuery('#'+ctrl_id).text();
                        }

                        //var param_value = jQuery('#'+ctrl_id).val();
                        //console.log(param_name,':p:',param_value);
                        post[param_name] = param_value;
                        //console.log(post);
                    }

                }
            }

            post.page_num = this.pGetCurrentPage();
            post.frm = ppaging.frm;
            post.type = 'json';
            post.page_size = this.pGetPerPage();//jQuery('#page_size').val();
            post._token = this.pGetTokenDom().val();
            post.srch = this.ppaging.search.trim();// this.pGetSrchDom().val(); pSyncSearch Prepares this.ppaging.search variable .. use that instead
            post.filter_name = this.pGetFilterByDom().val();
            post.order = this.pGetAscDesc();
            post.sort_by = this.pGetOrderBy();
            return post;
        };

        this.pSetDomObjects = function(data) {
            //this.pGetGoToDom().val('');
            jQuery(this._frmid+' #'+this.ppaging.page_num_span).html(this.pGetCurrentPage());
            jQuery(this._frmid+' #'+this.ppaging.total_pages_span).html(this.pGetTotalPages());
            jQuery(this._frmid+' #'+this.ppaging.page_range_text).html("");
            if (this.pGetTotalPages() > 0) {
                jQuery(this._frmid+' #'+this.ppaging.page_range_text).html("Showing page " + this.pGetCurrentPage() + " of " + this.pGetTotalPages());
                this.pGetGoToDom().val(this.pGetCurrentPage());

            }
        };

        this.pSetPagingObject = function(data) {
            data.page_size = parseInt(data.page_size); // convert from string to integer
            data.total_rows = parseInt(data.total_rows); // convert from string to integer
            data.page_num = parseInt(data.page_num); // convert from string to integer
            //console.log('pSetPagingObject');
            this.pSetPerPage(data.page_size);

            this.pSetCurrentPage(data.page_num);
            var total_pages = Math.ceil(data.total_rows / data.page_size);
            //console.log(data);
            //console.log('total_pages',total_pages)
            /* Remove hiding logic, also see line areound 116 to 118
            if(total_pages > 1) jQuery(this._frmid+' #'+this.ppaging.paging_container_div).css('display','block');
            else jQuery(this._frmid+' #'+this.ppaging.paging_container_div).css('display','none');
            */
            this.pSetTotalPages(total_pages);

        };
		/*
		this.pPrepareSearchArray = function() {
			console.log("pPrepareSearchArray");
			console.log($('#'+this._search_form_id));
			console.log($('#'+this._search_form_id).serializeArray());
		};
		*/
		
        this.pSyncSearch = function() {
			this.ppaging.search = "";
			//console.log('pSyncSearch',this._search_mode)
			if(this._search_mode == 'simple')
			{
				//console.log('search mode is simple')
				this.ppaging.search = this.pGetSrchDom().val();
			}
			else if(this._search_mode == 'advance')
			{
				//console.log('search mode is advanced');
				this.ppaging.search = $('#'+this._search_form_id).serialize(); // an '&' in this.paging.search means it is an 'advance' search 'simple' search will not have it. so server side script must take care of it.
			}
			//console.log('psyncsearch_callback is ',this.ppaging.psyncsearch_callback)
			
			var temp = this.ppaging.psyncsearch_callback(); // must be a  simple string like var=value or simply ''
			this.ppaging.search = this.ppaging.search + (temp == "" ? "" : "&" + temp);
			
        };

        this.pSyncFilterBy = function() {
            this.ppaging.filter_by = this.pGetFilterByDom().val();
        };
        /*
         function pSyncOrderBy()
         {
         j_order = jQuery('.sort_grd.asc').first().attr('column_name');
         ppaging.filter_by = pGetOrderByDom().val();
         }
         */

        this.pGetCurrentPage = function() {
            return this.ppaging.current_page;
        };

        this.pSetCurrentPage = function(page_num) {
            this.ppaging.current_page = page_num;
        };

        this.pRefreshAction = function() {
            //console.log('in prefresh action');
            this.pPrepareRequest();
            this.pSubmit();
        };

        this.pNextAction = function() {

            if (this.pGetCurrentPage() < this.pGetTotalPages()) {
                this.pSetCurrentPage(this.pGetCurrentPage() + 1);
                this.pPrepareRequest();
                this.pSubmit();
            }
            else{ // last page?? go back to page 1 WHEN next is pressed
                this.pSetCurrentPage(1);
                this.pPrepareRequest();
                this.pSubmit();
            }
            return false;
        };

        this.pPreviousAction = function() {

            if (this.pGetCurrentPage() > 1) {
                this.pSetCurrentPage(this.pGetCurrentPage() - 1);
                this.pPrepareRequest();
                this.pSubmit();
            }
            else { // 1st page?? go back to last page WHEN previous is pressed
                this.pSetCurrentPage(this.pGetTotalPages());
                this.pPrepareRequest();
                this.pSubmit();
            }
            return false;
        };

        this.pSettingsAction = function() {
            //alert('pSettingsAction');
            var goto_page = parseInt(this.pGetGoToDom().val());
            var per_page = parseInt(this.pGetPerPageDom().val());
            //console.log('goto_page:',goto_page,'per_page',per_page);
            if (goto_page >= 1 && goto_page <= this.pGetTotalPages()) {

                this.pSetCurrentPage(goto_page);
                this.pSetPerPage(per_page);
                this.pPrepareRequest();
                this.pSubmit();
            }
            else if (isNaN(goto_page)) {
                this.pSetCurrentPage(1);
                this.pSetPerPage(per_page);
                this.pPrepareRequest();
                this.pSubmit();
            }
        };

        this.pShowRowOnChangeAction = function() {
            //this.pGetGoToDom().val("");
            this.pGetGoToDom().val("1");
            this.pSettingsAction();
        };

        this.pSearchAction = function(force_submit) {
            //console.log('force_submit',force_submit)
            //console.log(pGetSrchDom().val())
            //console.log('psearch:',this.pGetSrchDom(),':psearval:',this.pGetSrchDom().val(),':')
            if ( force_submit || ((typeof(this.pGetSrchDom().val())== "string") && (this.pGetSrchDom().val().trim() != "")) ) {
                //console.log('inside if pSearchAction')
                var per_page = parseInt(this.pGetPerPageDom().val());
                this.pSetCurrentPage(1);
                this.pSetPerPage(per_page);
                this.pPrepareRequest();
                this.pSubmit();
            }
        };
		/*
		this.pAdvancedSearchAction = function(formid) {
			
		};
		*/




        this.pSortAction = function(column_name, sort_order) {
            /**
             * pAscDscAction must be called in the context of DOM which has 'asc' , 'desc' class set. 'this' variable
             * must be set properly
             */
            if (sort_order == "") sort_order = "asc";
            this.pSetSortBy(column_name);
            this.pSetAscDesc(sort_order);
            this.pPrepareRequest();
            this.pSubmit();
        };

        this.pGetCsvAction = function(event) {
            var loc = this.pGetStaticPrefixDom().val();
            loc = decodeURIComponent(loc);
            loc = loc + '/getcsv';
            var post = this.pGetPostObject();
            var params = this.serialize(post);
            //console.log(loc, ':', params);
            jQuery(event.target).attr('href', loc + "?" + params)
            return true;
        };

        this.serialize = function (obj) {
            var str = [];
            for (var p in obj)
                if (obj.hasOwnProperty(p)) {
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
            return str.join("&");
        }

        this.pGoto = function() {
        };


        this.pGetOrderBy = function() {
            return this.ppaging.sort_by;
        };

        this.pSetSortBy = function(field) {
            this.ppaging.sort_by = field;
        };

        this.pGetAscDesc = function() {
            return this.ppaging.order;
        };

        this.pSetAscDesc = function(order) {
            this.ppaging.order = order;
        };

        this.pGetTotalPages = function() {
            return this.ppaging.total_pages;
        };

        this.pSetTotalPages = function(total_pages) {
            this.ppaging.total_pages = total_pages;
        };

        this.pGetPerPage = function() {
            return this.ppaging.per_page;
        };

        this.pSetPerPage = function(page) {
            this.ppaging.per_page = page;
        };

        this.pSyncPerPage = function() {
            this.ppaging.per_page = pGetPerPageDom().val();
        };

        this.pRemoveFilter = function() {
        }
        /*
         function pFirst()
         {
         }
         function pLast()
         {
         }
         */
        this.pPrepareRequest = function() {
            this.pSyncSearch();
            this.pSyncFilterBy();
        };


        this.pGetStaticPrefixDom = function() {
            return jQuery(this._frmid+' #'+this.ppaging.static_prefix);
        };

        this.pGetGoToDom = function() {
            return jQuery(this._frmid+' #'+this.ppaging.goto);
        };

        this.pGetPerPageDom = function() {
            return jQuery(this._frmid+' #'+this.ppaging.page_size);
        };

        this.pGetFilterByDom = function() {
            return jQuery(this._frmid+' #'+this.ppaging.filter_name);
        };

        this.pGetSrchDom = function() {
            return jQuery(this._frmid+' #'+this.ppaging.searchid);
        };

        this.pGetTokenDom = function() {
            return jQuery(this._frmid+' #'+this.ppaging._token);
        };

        this.pGridHeaderClick = function(event) {
            //console.log('GridHeaderClick');
            var jtitle = jQuery(event.target);
            sort_order = "asc";
            if (jtitle.hasClass("asc")) sort_order = "desc";
            if (jtitle.hasClass("desc")) sort_order = "asc";
            this.pSortAction(jtitle.attr("column_name"), sort_order);

        }

        this.onFilter = function() {
            var srch = $(this._frmid+' #'+this.ppaging.searchid).val();
            var filter = $(this._frmid+' #'+this.ppaging.filter_name).val();
            //console.log('srch:',srch,':filter:',filter);
            if($.trim(srch)){
                $(this._frmid+' #filter').html('You are using filter: <b>' + $(this._frmid+' #filter_name option:selected').text() + '</b>');
                //$(this._frmid+' #filter').append(',['+srch+']&nbsp;<a class="clear_filter" onclick="pClearFilterAction();">clear filter</a>').addClass('show_result');
                $(this._frmid+' #filter').append(',['+srch+']&nbsp;<a class="clear_filter" >clear filter</a>').addClass('show_result');

                $(this._frmid+' .clear_filter').on('click', $.proxy(this.pClearFilterAction, this));

                this.pSearchAction();
            }
            else
            {
                //pageClick2(1);
                this.pSearchAction();
            }
            $('.sub_page_details').hide();
        }
        this.pClearFilterAction = function() {
            if(parseInt(this.pGetTotalPages()) == 0) this.pSetTotalPages(1); // in case if previous search returned total_pages 0 then make it 1 before making request otherwise grid will not send request on pSettingsAction
            this.onFilterClear();
            this.pSettingsAction();
        };
        this.onFilterClear = function() {
            srch = '';
            filter = '';
            $(this._frmid+' #filter').html('').removeClass('show_result');
            $(this._frmid+' #'+this.ppaging.searchid).val('');
            //callGridAjax();
        }

        this._apply = function(method, ctx, data) {
            //.log('====apply===');
            //console.log(arguments);
            var temp = data;
            return function() {
                return method.apply(ctx, temp)
            }
        }
        this._init = function() {

            this._frmid = '#'+this.ppaging.frm;  // it is parent of each html control , very important

            //$(document).on('click','#'+this.ppaging.pprev,function(){console.log('clicked bhai..')})

            jQuery(document).on('click', this._frmid+' #'+this.ppaging.pprev,
                this._apply(this.pPreviousAction, this));
            jQuery(document).on('click', this._frmid+' #'+this.ppaging.pnext,
                this._apply(this.pNextAction, this));
            jQuery(document).on('change', this._frmid+' #'+this.ppaging.page_size,
                this._apply(this.pShowRowOnChangeAction, this));
            jQuery(document).on('click', this._frmid+' #'+this.ppaging.paging_settings,
                this._apply(this.pSettingsAction, this));
            jQuery(document).on('click', this._frmid+' .sort_grd td:not(".no_sort")',
                jQuery.proxy(this.pGridHeaderClick, this));

            // if refresh button exists then attach refresh event
            if(jQuery(this._frmid+' #'+this.ppaging.refresh_button)){
                jQuery(document).on('click', this._frmid+' #'+this.ppaging.refresh_button,
                    this._apply(this.pRefreshAction, this));
            }

            // if refresh button exists then attach refresh event
            if(jQuery(this._frmid+' #'+this.ppaging.on_filter))
            {
                jQuery(document).on('click', this._frmid+' #'+this.ppaging.on_filter,
                    this._apply(this.onFilter, this));
            }

            for(i=0; i < this.ppaging.forms.length; i++)
            {
                if(this.ppaging.forms[i].constructor == String) // array contains form id string
                {

                    jQuery('#'+this.ppaging.forms[i]).submit(jQuery.proxy(function () {
                        this.pSettingsAction();
                        return false;
                    }, this));
                }
                else
                {

                    if(this.ppaging.forms[i].type == "search") // array contains object and form type is search
                    {
                        this._search_mode = false; // no search available
                        this._search_form_id = this.ppaging.forms[i].id;
                        if(jQuery('#'+this.ppaging.forms[i].id+' #srch').length) // text input 'srch' found it means it is a simple search form
                        {

                            this._search_mode = 'simple';
                            //console.log('simple search');
                            jQuery('#'+this.ppaging.forms[i].id).submit(jQuery.proxy(function () {
                                this.pSearchAction();
                                return false;
                            }, this));
                        }
                        else // complex search with multiple form fields, text , checkbox etc
                        {
                            //console.log('advanced search');
                            //console.log('#'+this.ppaging.forms[i].id);

                            this._search_mode = 'advance';
                            jQuery('#'+this.ppaging.forms[i].id).submit(jQuery.proxy(function () {
                                this.pSearchAction(true); // force submit
                                return false;
                            }, this));

                        }
                    }
                    else
                    {
                        //console.log('form type is settings');
                        jQuery('#'+this.ppaging.forms[i].id).submit(jQuery.proxy(function () {
                            this.pSettingsAction();
                            return false;
                        }, this));
                    }
                }
            }
			
			if(this.ppaging.debug)
			{
				//console.log('this.ppaging is', this.ppaging);
				//console.log('_frmid is ',this._frmid);
				//console.log('jqueyr(this._frmid this.ppaging.pprev) is ',jQuery(this._frmid+' #'+this.ppaging.pprev));
				//console.log('jqueyr(this._frmid this.ppaging.pnext) is ',jQuery(this._frmid+' #'+this.ppaging.pnext));
			}
            this.ppaging.post_init();
        };

        this._init.apply(this);







    }