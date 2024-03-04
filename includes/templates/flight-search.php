<form name="search-form" method="post">
    <label for="origin">Origin:</label><br>
    <input type="text" id="origin" name="origin"><br>
    <div id="origin-suggestions"></div>
    <label for="destination">Destination:</label><br>
    <input type="text" id="destination" name="destination"><br>
    <label for="departure_date">Departure Date:</label><br>
    <input type="date" id="departure_date" name="departure_date"><br>
    <label for="return_date">Return Date:</label><br>
    <input type="date" id="return_date" name="return_date"><br>

    <label for="adult">Adult:</label><br>
    <input type="number" id="adult" name="adult"><br>

    <label for="child">Child:</label><br>
    <input type="number" id="child" name="child"><br>
    <input type="submit" value="Search">
</form>

<script>
    const apiWithEndpoint = 'https://sky-scanner3.p.rapidapi.com/flights/auto-complete?query=';
    const form = document.forms['search-form'];
    const apiKey = '9ee8ccde51msh9e2a5bcb8d19c18p11fd3ajsn8968ad813011';
    const apiHost = 'sky-scanner3.p.rapidapi.com';

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // prevent the form from being submitted normally

        const formData = new FormData(form);
        const formValues = Object.fromEntries(formData.entries());

        searchOrigin(formValues)
            .then(data => {
                console.log(data);
            });
    });

    // Create a function to search for flights
    const searchOrigin = async (formValues) => {
        const originInput = document.getElementById('origin');
        // Set up the autocomplete function for the origin field

        const url = `https://sky-scanner3.p.rapidapi.com/flights/auto-complete?query=${formValues.origin}`;
        const options = {
            method: 'GET',
            headers: {
                'X-RapidAPI-Key': apiKey,
                'X-RapidAPI-Host': apiHost
            }
        };

        try {
            const response = await fetch(url, options);
            const result = await response.json();
            const suggestions = result.data.map(place => place.presentation.suggestionTitle);
            document.getElementById('origin-suggestions').innerHTML = suggestions.join('<br/>');
        } catch (error) {
            console.error(error);
        }
    };
</script>