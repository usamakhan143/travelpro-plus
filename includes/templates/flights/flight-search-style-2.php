<!-- Loader HTML -->
<div class="flight-loader-wrapper">
    <div class="loader"></div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card flight-form-card-6">
            <div class="card-body">
                <form name="search-form" method="post">
                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tripType" id="oneWay" value="oneWay" checked>
                            <label class="form-check-label triptypelabel" for="oneWay">One Way</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tripType" id="roundTrip" value="roundTrip">
                            <label class="form-check-label triptypelabel" for="roundTrip">Round Trip</label>

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <div class="travelpro-search-flight-input-group-2">
                                <label class="bootstrap-form-label">From</label>
                                <input class="form-control input--style-1" type="text" id="travelpro-plus-flight-origin" name="origin" placeholder="City, Region or Airport" required="required">
                                <div class="icon-container origin-loader">
                                    <i class="spinner"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="travelpro-search-flight-input-group-2">
                                <label class="bootstrap-form-label">To</label>
                                <input class="form-control input--style-1" type="text" id="travelpro-plus-flight-destination" name="destination" placeholder="City, Region or Airport" required="required">
                                <div class="icon-container destination-loader">
                                    <i class="spinner"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="bootstrap-form-label">Cabin Class</label>
                            <select class="form-select select--style-1" name="cabin">
                                <option value="economy">Economy</option>
                                <option value="premium_economy">Premium Economy</option>
                                <option value="business">Business</option>
                                <option value="first">First</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6 depart-date">
                            <label class="bootstrap-form-label">Depart</label>
                            <input class="form-control input--style-1" type="date" name="depart" required>
                        </div>
                        <div class="col-md-3 return-date">
                            <label class="bootstrap-form-label">Return</label>
                            <input class="form-control input--style-1" type="date" name="return">
                        </div>
                        <div class="col-md-5">
                            <label class="bootstrap-form-label">Passengers</label>
                            <div class="input-group">
                                <div class="input-group-icon" id="js-select-special">
                                    <input class="input--style-1 input--text-small" type="text" name="passengers" value="1 Adult, 0 Child, 0 Infant" disabled="disabled" id="info" />
                                    <i class="zmdi zmdi-plus input-icon"></i>
                                </div>
                                <div class="dropdown-select">
                                    <ul class="list-room">
                                        <li class="list-room__item">
                                            <span class="list-room__name">Passengers</span>
                                            <ul class="list-person">
                                                <li class="list-person__item">
                                                    <span class="name">Adult</span>
                                                    <div class="quantity quantity1">
                                                        <span class="minus">-</span>
                                                        <input class="inputQty" type="number" min="1" value="1" />
                                                        <span class="plus">+</span>
                                                    </div>
                                                </li>
                                                <li class="list-person__item">
                                                    <span class="name">Child</span>
                                                    <div class="quantity quantity2">
                                                        <span class="minus">-</span>
                                                        <input class="inputQty" type="number" min="0" value="0" />
                                                        <span class="plus">+</span>
                                                    </div>
                                                </li>
                                                <li class="list-person__item">
                                                    <span class="name">Infant</span>
                                                    <div class="quantity quantity3">
                                                        <span class="minus">-</span>
                                                        <input class="inputQty" type="number" min="0" value="0" />
                                                        <span class="plus">+</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
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