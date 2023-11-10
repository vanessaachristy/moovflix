document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const movieId = urlParams.get("id");

    function fetchMovieDetails(movieId) {
        fetch(`script/php/get_movies_details.php?id=${movieId}`)
            .then(response => response.json())
            .then(data => {
                updateMovieDetails(data);
            })
            .catch(error => console.error('Error fetching movies:', error));
    }

    function updateMovieDetails(movieDetails) {
        const title = document.getElementById('movie-title');
        const genre = document.getElementById('movie-genre');
        const language = document.getElementById('movie-language');
        const duration = document.getElementById('movie-duration');
        const poster = document.getElementById('movie-poster');
        const rating = document.getElementById('movie-rating');
        const director = document.getElementById('movie-director');
        const cast = document.getElementById('movie-cast');
        const synopsis = document.getElementById('movie-synopsis');

        title.textContent = movieDetails.movie_name;
        genre.textContent = movieDetails.genre;
        language.textContent = movieDetails.languages;
        duration.textContent = movieDetails.duration;
        poster.src = movieDetails.poster;
        rating.textContent = movieDetails.rating;
        director.textContent = movieDetails.director;
        cast.textContent = movieDetails.cast;
        synopsis.textContent = movieDetails.synopsis;
    }

    function fetchCinemas() {
        fetch('script/php/get_cinemas.php')
            .then(response => response.json())
            .then(data => {
                updateCinemaCarouselList(data);
            })
            .catch(error => console.error('Error fetching cinemas:', error));
    }

    function fetchShows(movieId, callback) {
        fetch(`script/php/get_shows_movies.php?id=${movieId}`)
            .then(response => response.json())
            .then(data => {
                callback(data);
            })
            .catch(error => console.error('Error fetching shows:', error));
    }

    function updateCinemaCarouselList(cinemas) {
        const movieCarouselContainer = document.getElementById('movie-carousel-container');

        movieCarouselContainer.innerHTML = '';

        let currentCinemaBox = null;

        cinemas.forEach((screen, index) => {

            currentCinemaBox = document.createElement('div');
            currentCinemaBox.classList.add('cinema-box');

            const cinemaLocationName = document.createElement('div');
            cinemaLocationName.classList.add('cinema-location-name');

            cinemaLocationName.innerHTML = `<img src="img/location.png" class="location-name-icon"><h2 id="cinema-name">${screen.cinema_name}</h2>`;
            currentCinemaBox.appendChild(cinemaLocationName);

            const dateCarousel = document.createElement('div');
            dateCarousel.classList.add('date-carousel');
            dateCarousel.id = 'date-carousel-' + (index + 1);

            dateCarousel.innerHTML = `
            <a href="#" class="prevDate" id="prevDate" role="button"><img class="next-arrow" src="img/left-arrow.svg" alt=""></a>
            <a href="#" role="button" class="date-items"><h3>Friday, 20 October</h3></a>
            <a href="#" role="button" class="date-items"><h3>Saturday, 21 October</h3></a>
            <a href="#" role="button"class="date-items"><h3>Sunday, 22 October</h3></a>
            <a href="#" role="button"class="date-items"><h3>Monday, 23 October</h3></a>
            <a href="#" role="button"class="date-items"><h3>Thursday, 24 October</h3></a>
            <a href="#" class="nextDate" id="nextDate" role="button"><img class="next-arrow next-arrow-right" src="img/arrow-right.svg" alt=""></a>
            `;

            const cinemaTime = document.createElement('div');
            cinemaTime.classList.add('cinema-time-list');

            cinemaTime.innerHTML = `
                    <input type="button" class="cinema-time" value="xx:xx">
                    <input type="button" class="cinema-time" value="xx:xx">
                    <input type="button" class="cinema-time" value="xx:xx">
            `;

            const dateItems = dateCarousel.querySelectorAll('.date-items');
            const cinemaTimeButtons = cinemaTime.querySelectorAll('.cinema-time')


            dateItems.forEach((dateItem) => {
                dateItem.addEventListener('click', (event) => {
                    event.preventDefault();
                    const selectedDateText = dateItem.querySelector('h3').textContent;
                    const formattedSelectedDate = formatDateForComparison(selectedDateText);

                    fetchShows(movieId, (data) => {
                        const showsByDate = {};
                        const showIDs = {};
                        const currentTime = new Date();
                        for (let i = 0; i < data.length; i++) {
                            const show = data[i];
                            if (screen.id === show.screenID && formattedSelectedDate === show.dates.split(' ')[0]) {
                                const showTime = show.dates.split(' ')[1].slice(0, 5);
                                const showDateTime = new Date(`${formattedSelectedDate}T${showTime}:00`);
                                if (showDateTime > currentTime) {
                                    showsByDate[showTime] = showsByDate[showTime] || 0;
                                    showsByDate[showTime]++;
                                    showIDs[showTime] = show.id;
                                }
                            }
                        }

                        cinemaTimeButtons.forEach((button, index) => {
                            const showTimes = Object.keys(showsByDate);

                            if (index < showTimes.length) {
                                button.value = showTimes[index];
                                button.id = showIDs[showTimes[index]];
                                button.onclick = () => {
                                    redirectToSeating(showIDs[showTimes[index]]);
                                }
                                button.style.display = 'block';
                            } else {
                                button.style.display = 'none';
                            }
                        });
                    });
                });
            });


            currentCinemaBox.appendChild(dateCarousel);
            currentCinemaBox.appendChild(cinemaTime);

            movieCarouselContainer.appendChild(currentCinemaBox);

            setupDateCarousel(currentCinemaBox.querySelector('.date-carousel'), index + 1);


        });
    }

    function formatDateForComparison(selectedDateText) {
        const date = new Date(selectedDateText);

        const currentDate = new Date();

        const year = currentDate.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');

        return `${year}-${month}-${day}`;
    }


    function updateDates(carousel, currentDateIndex) {
        const dateItems = carousel.querySelectorAll('.date-items h3');
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        dateItems.forEach((item, index) => {
            const date = new Date(today);
            date.setDate(today.getDate() + currentDateIndex + index);
            const options = { weekday: 'long', day: 'numeric', month: 'long' };
            item.textContent = date.toLocaleDateString(undefined, options);
        });
    }

    function setupDateCarousel(dateCarousel) {
        const nextButton = dateCarousel.querySelector("#nextDate");
        const prevButton = dateCarousel.querySelector("#prevDate");

        let currentDateIndex = 0;
        let firstDateIndex = 0;
        let selectedDateIndex = 0;
        const dateItems = dateCarousel.querySelectorAll('.date-items h3');

        const updateSelection = (index) => {
            selectedDateIndex = index; 
            dateItems.forEach((item, i) => {
                if (i === index) {
                    item.style.color = "#F5CB5C";
                } else {
                    item.style.color = "#FFFFFF";
                }
            });
        };

        const updateDateItems = () => {
            dateItems.forEach((dateItem, index) => {
                if (index === selectedDateIndex) {
                    setTimeout(() => {
                        dateItem.click();
                    }, 0);
                }
            });
        };

        dateItems.forEach((dateItem, index) => {
            dateItem.addEventListener('click', (event) => {
                event.preventDefault();
                updateSelection(index);
            });
            if (index === currentDateIndex) {
                setTimeout(() => {
                    dateItem.click();
                }, 0);
            }
        });

        nextButton.addEventListener("click", function (event) {
            event.preventDefault();
            if (currentDateIndex < 14) {
                currentDateIndex++;
                selectedDateIndex--; 
                if (selectedDateIndex < 0) {
                    selectedDateIndex = firstDateIndex; 
                }
                updateSelection(selectedDateIndex);
                updateDateItems();
                updateDates(dateCarousel, currentDateIndex);
            }
        });
        
        prevButton.addEventListener("click", function (event) {
            event.preventDefault();
            if (currentDateIndex > 0) {
                selectedDateIndex++; 
                currentDateIndex--;
                updateSelection(selectedDateIndex);
                updateDates(dateCarousel, currentDateIndex);
                updateDateItems();
            }
        });
        

        updateDates(dateCarousel, currentDateIndex);
        updateSelection(selectedDateIndex);
    }


    fetchMovieDetails(movieId);
    fetchCinemas();

    function redirectToSeating(showID) {
        let userEmail = localStorage.getItem("userEmail");
        let userName = localStorage.getItem("userName");
        let url = `login.php?id=${showID}`;
        if (userEmail && userName) {
            url = `booking-details/seating-page/index.php?id=${showID}`;
        }
        window.location.href = `${url}`
    }

});



