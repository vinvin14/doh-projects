<div class="container-fluid">
    <a href="/library"><i class="fa fa-angle-double-left"></i> Back to Library</a>
    <h5 class="border-bottom mt-2">Categories</h5>
    <div class="row mt-4">
        <div class="col-12 border-right">
            <div class="p-1">
                <div><button class="btn btn-outline-primary mb-2" data-toggle="modal" data-target="#categoryModal" data-backdrop="static" data-keyboard="false">New Category</button></div>
                <small class="font-weight-bold">Existing Categories</small>
                <small class="text-muted ml-2 font-italic">Hint: You can click each entry to update it</small>
                <input type="text" id="search" class="form-control col-4 search" id="" placeholder="Search Category here. . ." >
                <div class="list-group col-4" id="categories">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" id="category" class="form-control" placeholder="New Category here">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="createCategory" class="btn btn-primary">Save Category</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="categoryUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-2">
                    <input type="hidden" id="categoryId">
                    <input type="text" id="categoryInput" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="updateCategory" class="btn btn-primary">Update Category</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#categories button").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        referenceCategory('#categories', 'buttons');
        $('#updateCategory').click(function () {
            data = {
                'category': $('#categoryInput').val()
            };
            postCreate('/api/library/category/'+$('#categoryId').val(), data);
        });
        $('#createCategory').click(function (){
            if(dataRequired(['#category']) === 0) {
                data = {
                    'category': $('#category').val()
                };
                postCreate('/api/library/category/create', data);
            }
        });
        $('#categoryModal').on('hidden.bs.modal', function () {
            $('#category').val('');
            referenceCategory('#categories', 'buttons');

        });
        $('#categoryUpdateModal').on('hidden.bs.modal', function () {
            $('#categoryInput').val('');
            referenceCategory('#categories', 'buttons');
        });
    });
</script>
