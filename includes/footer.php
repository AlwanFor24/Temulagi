<!-- footer.php -->
</main>
<footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">&copy; <span id="year"></span> TEMULAGI | All Rights Reserved</p>
</footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // JavaScript to set the current year
    document.getElementById("year").textContent = new Date().getFullYear();


    // Get the current URL path (e.g., "contact.php")
    const currentPath = window.location.pathname.split('/').pop();

    // Select all <a> elements in the navigation
    const navLinks = document.querySelectorAll('a');

    // Loop through each <a> and check if its href matches the current path
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active'); // Add the 'active' class
        }
    });



</script>
</body>

</html>