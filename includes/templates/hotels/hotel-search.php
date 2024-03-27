<!-- Loader HTML -->
<div class="hotel-loader-wrapper">
    <div class="loader"></div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card flight-form-card-6">
            <div class="card-body">
                <form name="hotel-search-form" method="post">
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <div class="travelpro-search-flight-input-group-2">
                                <label class="bootstrap-form-label">Destination</label>
                                <input class="form-control input--style-1" type="text" id="travelpro-plus-hotel-destination" name="hotel-destination" placeholder="City, Region" required="required">
                                <div class="icon-container hotel-destination-loader">
                                    <i class="spinner"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="bootstrap-form-label">Check-in</label>
                            <input class="form-control input--style-1" type="date" name="hotel-check-in" required>
                        </div>
                        <div class="col-md-4">
                            <label class="bootstrap-form-label">Check-out</label>
                            <input class="form-control input--style-1" type="date" name="hotel-check-out" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-5">
                            <label class="bootstrap-form-label">Childrens</label>
                            <input class="form-control input--style-1" type="text" id="numberOfChildren" name="numberOfChildren" placeholder="Enter Child" readonly>
                        </div>
                        <div class="col-md-5">
                            <label class="bootstrap-form-label">Adults</label>
                            <input class="form-control input--style-1" type="number" id="numberOfAdultsInHotel" name="numberOfAdultsInHotel" placeholder="Enter Adult" required>
                        </div>
                        <div class="col-md-2">
                            <label class="bootstrap-form-label">&nbsp;</label>
                            <div class="d-grid">
                                <button class="btn btn-submit-for-bootstrap" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="childrenModal" tabindex="-1" aria-labelledby="childrenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="childrenModalLabel">
                    Enter Children Information
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="numberOfChildrenModal" class="form-label">Number of Children (Max 4):</label>
                    <input type="number" class="form-control" id="numberOfChildrenModal" min="1" max="4" />
                </div>
                <div class="row" id="childAgeFieldsModal"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addChildrenBtn">
                    Add
                </button>
            </div>
        </div>
    </div>
</div>