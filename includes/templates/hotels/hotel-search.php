<!-- Loader HTML -->
<div class="flight-loader-wrapper">
    <div class="loader"></div>
</div>

<div class="flight-form-card flight-form-card-5">
    <div class="flight-form-card-body">
        <form name="search-form" method="post">
            <div class="travelpro-search-fm-flight-row row-space">
                <div class="travelpro-search-flight-col-2">
                    <div class="travelpro-search-flight-input-group">
                        <label class="travelpro-search-flight-label">from</label>
                        <input class="input--style-1" id="travelpro-plus-flight-origin" type="text" name="origin" placeholder="City, Region or Airport" required="required" />
                        <div class="icon-container origin-loader">
                            <i class="spinner"></i>
                        </div>
                    </div>
                </div>
                <div class="travelpro-search-flight-col-2">
                    <div class="travelpro-search-flight-input-group">
                        <label class="travelpro-search-flight-label">to</label>
                        <input class="input--style-1" id="travelpro-plus-flight-destination" type="text" name="destination" placeholder="City, Region or Airport" required="required" />
                        <div class="icon-container destination-loader">
                            <i class="spinner"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="travelpro-search-fm-flight-row row-space">
                <div class="travelpro-search-flight-col-2">
                    <div class="travelpro-search-fm-flight-row row-space">
                        <div class="travelpro-search-flight-col-2">
                            <div class="travelpro-search-flight-input-group m-b-0">
                                <label class="travelpro-search-flight-label">Passengers</label>
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
                                                        <input class="inputQty" type="number" min="0" value="1" />
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
                                    <!-- <div class="list-room__footer">
                            <a href="#" id="btn-add-room">Add room</a>
                          </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="travelpro-search-flight-col-2">
                            <div class="travelpro-search-flight-input-group m-b-0">
                                <label class="travelpro-search-flight-label">Depart</label>
                                <input class="input--style-1" type="date" name="depart" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="travelpro-search-flight-col-2">
                    <div class="travelpro-search-fm-flight-row row-space">
                        <div class="travelpro-search-flight-col-2">
                            <div class="travelpro-search-flight-input-group m-b-0">
                                <label class="travelpro-search-flight-label">Return</label>
                                <input class="input--style-1" type="date" name="return" />
                            </div>
                        </div>
                        <div class="travelpro-search-flight-col-2">
                            <div class="submission-row">
                                <div class="select-container">
                                    <label class="travelpro-search-flight-label">Cabin Class</label>
                                    <select id="cabin" name="cabin" class="select--style-1">
                                        <option value="economy">Economy</option>
                                        <option value="premium_economy">Premium Economy</option>
                                        <option value="business">Business</option>
                                        <option value="first">First</option>
                                    </select>
                                </div>
                                <div class="button-container">
                                    <button class="travelpro-flight-search-btn-submit" type="submit">search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>