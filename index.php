<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Anime Quote</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="max-w-lg w-full bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Random Anime Quote</h1>
        <div id="quote" class="flex items-center mb-4">
            <div id="thumbnail" class="w-12 h-12 rounded-full overflow-hidden mr-4">
                <img id="thumbnailImage" src="" alt="Character Thumbnail">
            </div>
            <div id="quoteText"></div>
        </div>
        <button id="fetchQuote" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Get Another Quote
        </button>
    </div>
<br><br>
    <script>
        // Fetch random anime quote from API
        async function fetchRandomQuote() {
            const response = await fetch('https://anime-quotes.com/api?random');
            const data = await response.json();
            return data[0];
        }

        // Update the quote displayed on the page
        async function updateQuote() {
            const quoteElement = document.getElementById('quoteText');
            const thumbnailElement = document.getElementById('thumbnailImage');
            quoteElement.innerHTML = 'Loading quote...';

            const quote = await fetchRandomQuote();
            const { character, quote: text, anime, character_thumbnail_url } = quote;

            quoteElement.innerHTML = `
                <div><strong><a href="https://anime-quotes.com/character/${encodeURIComponent(character)}" target="_blank">${character}</a></strong> from <em><a href="https://anime-quotes.com/category/${encodeURIComponent(anime)}" target="_blank">${anime}</a></em> says:</div>
                <blockquote class="italic mb-2">${text}</blockquote>
            `;
            thumbnailElement.src = character_thumbnail_url;
        }

        // Fetch a new quote when the button is clicked
        document.getElementById('fetchQuote').addEventListener('click', updateQuote);

        // Initial load
        updateQuote();
    </script>
</body>
</html>
