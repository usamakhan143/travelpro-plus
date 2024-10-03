<!-- Loader HTML -->
<div class="hotel-loader-wrapper">
    <div class="loader"></div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card flight-form-card-6">
            <div class="card-body hotel-search-card">
                <form name="hotel-search-form" method="post">
                    <div class="mb-3 row">
                        <div class="col-md-3 p-0">
                            <div class="travelpro-search-flight-input-group-2">
                                <label class="bootstrap-form-label">Destination</label>
                                <i class="fa-solid fa-location-dot"></i>
                                <input class="form-control input--style-1" type="text" id="travelpro-plus-hotel-destination" name="hotel-destination" placeholder="City, Region" required="required">
                                <div class="icon-container hotel-destination-loader">
                                    <i class="spinner"></i>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <label class="bootstrap-form-label">Check-in</label>
                            <input class="form-control input--style-1" type="date" name="hotel-check-in" required id="start-date">
                        </div>
                        <div class="col-md-4">
                            <label class="bootstrap-form-label">Check-out</label>
                            <input class="form-control input--style-1" type="date" name="hotel-check-out" required id="end-date">
                        </div> -->
                        <div class="col-md-4 field-padding">

                            <div class="travelpro-search-flight-input-group-2">
                                <label class="bootstrap-form-label">Check-in & Check-out</label>
                                <i class="fa-regular fa-calendar-days"></i>
                                <input class="form-control input--style-1" type="text" name="hotel-checkin-checkout" required id="flat-start-end-date" placeholder="Check-in Date — Check-out Date" readonly required="required">
                            </div>
                            <input class="form-control input--style-1" type="hidden" name="hotel-check-in" required id="flat-start-date" placeholder="Check-in Date" readonly required="required">
                            <input class="form-control input--style-1" type="hidden" name="hotel-check-out" required id="flat-end-date" placeholder="Check-Out Date" readonly required="required">

                        </div>
                        <div class="col-md-3 field-padding people-selector-field">
                            <div class="travelpro-search-flight-input-group-2">
                                <label class="bootstrap-form-label">Adult & Children</label>
                                <i class="fa-solid fa-users"></i>
                                <input class="form-control input--style-1" type="text" id="peopleInput" name="peoples" placeholder="Select Adults, Child" required="required" readonly value="1 Adult(s), 0 Child(ren)">
                                <div id="peopleDropdown" class="dropdown-content">
                                    <!-- Rooms Selector -->
                                    <!-- <label for="rooms">Rooms:</label>
                                <select id="rooms">
                                    <option value="1">1 Room</option>
                                    <option value="2">2 Rooms</option>
                                    <option value="3">3 Rooms</option>
                                    <option value="4">4 Rooms</option>
                                    <option value="5">5 Rooms</option>
                                </select> -->

                                    <!-- Adults Selector -->
                                    <div class="combo-field-container">
                                        <label for="numberOfAdultsInHotel">Adults:</label>
                                        <i class="fa-solid fa-users"></i>
                                        <select id="numberOfAdultsInHotel" required>
                                            <option value="1">1 Adult</option>
                                            <option value="2">2 Adults</option>
                                            <option value="3">3 Adults</option>
                                            <option value="4">4 Adults</option>
                                            <option value="5">5 Adults</option>
                                        </select>
                                    </div>

                                    <!-- Children Selector -->
                                    <div class="combo-field-container">
                                        <label for="children">Children:</label>
                                        <i class="fa-solid fa-children"></i>
                                        <select id="children">
                                            <option value="0">0 Children</option>
                                            <option value="1">1 Child</option>
                                            <option value="2">2 Children</option>
                                            <option value="3">3 Children</option>
                                            <option value="4">4 Children</option>
                                            <option value="5">5 Children</option>
                                        </select>
                                    </div>

                                    <!-- Child Age Dropdowns Container -->
                                    <div id="childAgesContainer"></div>

                                    <!-- Confirm Selection Button -->
                                    <button id="confirmSelection">Confirm Selection</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 field-padding">
                            <label class="bootstrap-form-label">&nbsp;</label>
                            <div class="d-grid">
                                <button class="btn btn-submit-for-bootstrap" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="mb-3 row">
                        <div class="col-md-5">
                            <label class="bootstrap-form-label">Children</label>
                            <input class="form-control input--style-1" type="text" id="numberOfChildren" name="numberOfChildren" placeholder="Enter No. of Children" readonly>
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
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</div>


<div id="childrenModal" class="modal-travelpro">
    <!-- Modal content -->
    <div class="travelpro-modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h5 style="text-align: center;" id="childrenModalLabel">
            Enter Children Information
        </h5>
        <div style="text-align: center">
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