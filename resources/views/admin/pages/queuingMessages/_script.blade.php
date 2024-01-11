<style>
    .list tr td:nth-child(6) div{
        display: flex;
        align-items: center;
    }
    .yellow{
        background: #14427e;
        color: white;
    }
    .yellow i,
    .yellow button{
        color: white;
    }
</style>
@push('css')
    @css(aAdmin('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css'))
    @css(aAdmin('vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'))
    @css(aAdmin('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css'))
@endpush

@push('js')
    @js(aAdmin('vendor/datatables.net/js/jquery.dataTables.min.js'))
    @js(aAdmin('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js'))
    @js(aAdmin('vendor/datatables.net-buttons/js/dataTables.buttons.min.js'))
    @js(aAdmin('vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js'))
    @js(aAdmin('vendor/datatables.net-buttons/js/buttons.html5.min.js'))
    @js(aAdmin('vendor/datatables.net-buttons/js/buttons.flash.min.js'))
    @js(aAdmin('vendor/datatables.net-buttons/js/buttons.print.min.js'))
    @js(aAdmin('vendor/datatables.net-select/js/dataTables.select.min.js'))

    <script>
        const showTooltip = '{!! __('app.View') !!}';
        const showUrl = '{{ route('admin.queuing_message.show', ['id' => ':slug']) }}';

        const editTooltip = '{!! __('app.Show') !!}';
        const editUrl = '{{ route('admin.queuing_message.edit', ['id' => ':slug']) }}';

        const deleteTooltip = '{!! __('app.Destroy') !!}';

        //const userType = '{!! auth()->user()->type !!}';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        // Retrieve the status data from the server
        $.ajax({
            url: '{{ route('admin.queuing_message.listStatus') }}',
            type: 'GET',
            dataType: 'json',
            async: false, // Make the request synchronous
            success: function(response) {
                statusData = response;
                // Call the callback function to initialize the DataTable
                // initializeDataTable();

            },
            error: function(xhr, status, error) {
                // Handle error case
                console.log('AJAX error:', error);
            }

        });

        
        // $(document).on('click', '.add-comment', function() {
        //     var commentContainer = $(this).closest('.comment-container');
        //     commentContainer.find('.add-comment').hide();
        //     commentContainer.find('.comment-textarea').show();
        //     commentContainer.find('.save-comment').show();
        // });

  

        // Add an event listener to the "Save" button
            // $(document).on('click', '#saveCommentBtn', function() {
            //     var commentTextarea = $(this).closest('.comment-container').find('.comment-textarea');
            //     var comment = commentTextarea.val();
            //     var rowId = $(this).closest('tr').data('id');

            //     // Make an Ajax request to the Laravel route
            //     $.ajax({
            //         url: '{{ route('admin.queuing_message.edit', ['id' => ':slug']) }}'.replace(':slug', rowId),
            //         type: 'PUT',
            //         data: {
            //             comment: comment,
            //         },
            //         success: function(response) {
            //             // Handle the success response
            //             // ...
            //         },
            //         error: function(xhr, status, error) {
            //             // Handle the error case
            //             // ...
            //         }
            //     });
            // });


        // let statusData; 
        $('.dataTable').dataTable({
            order: [0, "desc"],
            pageLength: 100,
            lengthMenu: [10, 25, 50, 100, 250],
            orderCellsTop: true,
            fixedHeader: true,
            processing: true,
            serverSide: true,


            createdRow: function(row, data) {
                $(row).attr('data-id', data.id).addClass('item-row');
                // Event handler for updating the status
                if(data.status_id === 1){
                    console.log(data);
                    $(row).attr('data-id', data.id).addClass('yellow');
                }
               
                $(row).find('.status_select').on('change', function() {
                    var newStatusId = $(this).val();
                    var rowId = $(this).closest('tr').data('id');

                    // Make an AJAX request to update the status in the database
                    $.ajax({
                        url: '{{ route('admin.queuing_message.updateStatus') }}',
                        type: 'POST',
                        data: {
                            id: rowId,
                            status_id: newStatusId
                        },
                        success: function(response) {
                            setTimeout(function(){
                                location.reload();
                            }, 10)
                        },
                        error: function(xhr, status, error) {
                            console.log('Status update request error:', error);
                        }
                    });
                });
            },
            language: {
                // sProcessing: '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span> </div>'
                //processing: "<div id='datatable-loader'></div>",
                paginate: {
                    next: '<i class="fas fa-angle-right" title="{{ __('app.List.Next') }}"></i>',
                    previous: '<i class="fas fa-angle-left title="{{ __('app.List.Previous') }}"></i>'
                }
            },

            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {   
                    name: 'status',
                    render: function(data, type, row) {
                    var selectOption = '<select class="status_select" style="border:none;">';
                            
                        // Generate select options based on the status data
                        for (let i = 0; i < statusData.length; i++) {
                            // Check if the current option matches the item's status_id
                            if (statusData[i].id === row.status_id) {
                                selectOption += '<option class="option" value="' + statusData[i].id +
                                    '" selected>' + statusData[i].name + '</option>'; 
                            } else {
                                selectOption += '<option class="option" value="' + statusData[i].id +
                                    '">' + statusData[i].name + '</option>';
                            }
                        }
                       
                        // Complete the select element
                        selectOption += '</select>';
                       
                        // Update the select options in the desired column
                        $('td:eq(3)', row).html('<div class="custom-select">' + selectOption + '</div>');
                        // console.log(row.status_id)
                        return selectOption; // Return the select options synchronously
                      
                    }
                },
                // {
                //     data: 'comment',
                //     name: 'comment',
                //     render: function(data, type, row) {
                //         var commentHTML = '';
                        
                //         if (data) {
                //         commentHTML += '<textarea class="comment-textarea" name="comment" rows="2" cols="60" style="height: 45px;">' + data + '</textarea>';
                //         commentHTML += '<button id="saveCommentBtn" class="btn btn-sm btn-outline-primary save-comment ml-2">Save</button>';
                //     } else {
                //         commentHTML += '<button class="btn btn-sm btn-outline-primary add-comment">Add Comment</button>';
                //         commentHTML += '<textarea class="comment-textarea" name="comment" rows="2" placeholder="Add comment" cols="60" style="height: 45px; display: none;"></textarea>';
                //         commentHTML += '<button id="saveCommentBtn" class="btn btn-sm btn-outline-primary save-comment ml-2" style="display: none;">Save</button>';
                //     }
        
                        
                //         return '<div class="comment-container">' + commentHTML + '</div>';
                //     }
                // },
                {
                    data: 'tools',
                    name: 'tools',
                    className: 'text-right',
                    orderable: false,
                    searchable: false,
                    render: function(id, q, row) {
                        let tools = '';
                        
                        // tools += '<a class="btn btn-sm btn-icon-only btn-outline-info" ' +
                        //     'href="' + showUrl.replace(':slug', row.id) + '" ' +
                        //     'title="' + showTooltip +'">' +
                        //     '<i class="fas fa-eye"></i>' +
                        //     '</a>';

                        tools += '<a class="btn btn-sm btn-icon-only btn-outline-primary" ' +
                            'href="' + editUrl.replace(':slug', row.id) + '" ' +
                            'title="' + editTooltip + '">' +
                            '<i class="far fa-eye"></i>' +
                            '</a>';

                        tools += '<a class="btn btn-sm btn-icon-only btn-outline-danger delete" ' +
                            'href="javascript:void(0)" ' +
                            'title="' + deleteTooltip + '" ' +
                            'data-toggle="modal" ' +
                            'data-target="#itemDeleteModal">' +
                            '<i class="fas fa-times"></i>' +
                            '</a>';

                        /*if (parseInt(userType) === parseInt('{{ \App\Constants\UserRole::ADMIN }}')) {
                            tools += '<span class="d-inline-block" style="margin-left:4px;" data-toggle="modal" data-target="#itemDeleteModal">' +
                                '<a href="javascript:void(0)" class="icon-btn delete" ' + deleteTooltip + '></a>' +
                            '</span>'
                        }*/

                        return tools;
                    }
                }
            ],

            //order: [],
            ajax: {
                url: '{{ route('admin.queuing_message.listPortion') }}',
                type: 'POST',
                /*data: function (e) {
                    return getSearchParams(e)
                }*/
            },
            dom: 'lBfrtip',
            buttons: [],
        });

        var itemId = $('#pdf-item-id'),
            blocked = false,
            modal = $('#itemDeleteModal');
        loader = modal.find('.modal-loader');

        function modalError() {
            loader.removeClass('shown');
            blocked = false;
            //toastr.error('{{ t('Admin action notify.error') }}');
            modal.modal('hide');
        }

        modal.on('show.bs.modal', function(e) {
            if (blocked) return false;
            var $this = $(this),
                button = $(e.relatedTarget),
                thisItemRow = button.parents('.item-row');
            itemId.val(thisItemRow.data('id'));
        }).on('hide.bs.modal', function(e) {
            if (blocked) return false;
        });
        $('#itemDeleteForm').on('submit', function() {
            let url = "{!! route('admin.queuing_message.delete', ['id' => ':slug']) !!}";
            if (blocked) return false;
            blocked = true;
            var thisItemId = itemId.val();
            if (thisItemId && thisItemId.match(/^[1-9][0-9]{0,9}$/)) {
                loader.addClass('shown');
                $.ajax({
                    url: url.replace(':slug', thisItemId),
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: csrf,
                        _method: 'delete',
                        itemId: thisItemId,
                    },
                    error: function(e) {
                        modalError();
                    },
                    success: function(response) {
                        if (response) {
                            loader.removeClass('shown');
                            blocked = false;
                            //toastr.success('{{ t('Admin action notify.success') }}');
                            modal.modal('hide');
                            $('.item-row[data-id="' + thisItemId + '"]').fadeOut(function() {
                                $(this).remove();
                            });
                        } else modalError();
                    }
                });
            } else modalError();
        });

        $('#statusFilter').change(function() {
            var selectedValue = +$(this).val(); 
            $('.dataTable').DataTable().rows().every(function() {
                var row = this.node();
                var rowData = this.data();
                var statusId = rowData.status_id; 
                if (selectedValue === statusId) { 
                    $(row).show();
                }else if (selectedValue ===  0) { 
                    $(row).show();
                }else { 
                    $(row).hide();
                }
            });
        });
    </script>
@endpush
