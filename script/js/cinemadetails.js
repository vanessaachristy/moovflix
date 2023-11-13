document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const cinemaId = urlParams.get("id");

    function fetchCinemaDetails(cinemaId) {
        fetch(`script/php/get_cinema_details.php?id=${cinemaId}`)
            .then(response => response.json())
            .then(data => {
                updateCinemaDetails(data); 
            })
            .catch(error => console.error('Error fetching cinemas:', error));
    }

    function updateCinemaDetails(cinemaDetails){
        const cinemaName = document.getElementById('cinema-name');

        cinemaName.textContent = cinemaDetails.cinema_name; 
    }

    function fetchMovies() {
        fetch('script/php/get_movies.php')
            .then(response => response.json())
            .then(data => {
                updateMovieCarouselList(data); 
            })
            .catch(error => console.error('Error fetching movies:', error));
    }

    function fetchShows(cinemaId, callback) {
        fetch(`script/php/get_shows_cinemas.php?id=${cinemaId}`)
            .then(response => response.json())
            .then(data => {
                callback(data); 
            })
            .catch(error => console.error('Error fetching shows:', error));
    }

    function updateMovieCarouselList(movies) {
        const movieCarouselContainer = document.getElementById('movie-carousel-container');

        movieCarouselContainer.innerHTML = '';

        let currentMovieBox = null;

        movies.forEach((movies, index) => {
            
            currentMovieBox = document.createElement('div');
            currentMovieBox.classList.add('cinema-box', 'movie-box');

            const movieName = movies.movie_name; 
            const movieLanguage = movies.languages; 
            const movieRating = movies.rating; 
            
            const movieTitle = document.createElement('h2');
            movieTitle.innerHTML = `${movieName} &#40;<span class="languages">${movieLanguage}</span>&#41; <span class="rating">${movieRating}</span>`;
            currentMovieBox.appendChild(movieTitle);

            const dateCarousel = document.createElement('div');
            dateCarousel.classList.add('date-carousel');
            dateCarousel.id = 'date-carousel-' + (index + 1);

            dateCarousel.innerHTML = `
            <a href="#" id="prevDate" role="button"><img class="next-arrow" src="img/left-arrow.svg" alt=""></a>
            <a href="#" role="button" class="date-items"><h3>Friday, 20 October</h3></a>
            <a href="#" role="button" class="date-items"><h3>Saturday, 21 October</h3></a>
            <a href="#" role="button"class="date-items"><h3>Sunday, 22 October</h3></a>
            <a href="#" role="button"class="date-items"><h3>Monday, 23 October</h3></a>
            <a href="#" role="button"class="date-items"><h3>Thursday, 24 October</h3></a>
            <a href="#" id="nextDate" role="button"><img class="next-arrow next-arrow-right" src="img/arrow-right.svg" alt=""></a>
            `;

            const movieTime = document.createElement('div'); 
            movieTime.classList.add('cinema-time-list', 'movie-time-list'); 

            movieTime.innerHTML = `
                    <img src="${movies.poster}" alt="" class="movie-picture">
                    <input type="button" class="cinema-time movie-time" value="xx:xx">
                    <input type="button" class="cinema-time movie-time" value="xx:xx">
                    <input type="button" class="cinema-time movie-time" value="xx:xx">
            `;

            const dateItems = dateCarousel.querySelectorAll('.date-items');
            const movieTimeButtons = movieTime.querySelectorAll('.cinema-time', '.movie-time');

            dateItems.forEach((dateItem) => {
                dateItem.addEventListener('click', (event) => {
                    event.preventDefault();
                    const selectedDateText = dateItem.querySelector('h3').textContent;
                    const formattedSelectedDate = formatDateForComparison(selectedDateText);

                    fetchShows(cinemaId, (data) => {
                        const showsByDate = {};
                        const showIDs = {};
                        const currentTime = new Date();

                        console.log(data); 

                        for (let i = 0; i < data.length; i++) {
                            const show = data[i];

                            if (movies.id === show.movieID && formattedSelectedDate === show.dates.split(' ')[0]) {
                                const showTime = show.dates.split(' ')[1].slice(0, 5);
                                const showDateTime = new Date(`${formattedSelectedDate}T${showTime}:00`);
                                if (showDateTime > currentTime){
                                    showsByDate[showTime] = showsByDate[showTime] || 0;
                                    showsByDate[showTime]++;
                                    showIDs[showTime] = show.id;
                                }
                            }
                        }

                        movieTimeButtons.forEach((button, index) => {
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
    
            currentMovieBox.appendChild(dateCarousel);
            currentMovieBox.appendChild(movieTime);
    
            movieCarouselContainer.appendChild(currentMovieBox);

            setupDateCarousel(currentMovieBox.querySelector('.date-carousel'), index + 1);

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
        today.setHours(0,0,0,0); 
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
            if (currentDateIndex < 10) {
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
    

    fetchCinemaDetails(cinemaId);
    fetchMovies()

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
