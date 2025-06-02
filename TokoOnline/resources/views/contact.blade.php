<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-100 to-indigo-200 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-3xl bg-white p-10 rounded-xl shadow-lg border border-gray-200">
        
        <!-- Back Button Box -->
        <div class="mb-6">
              <a href="{{ url('/beranda') }}"
               class="inline-block px-5 py-2 bg-gray-200 text-gray-700 rounded-lg shadow hover:bg-gray-300 transition text-sm font-semibold">
                ← Back to Home 
            </a>
        </div>

        <!-- Title -->
        <h1 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Contact Us</h1>

        <!-- Flash Message -->
        @if(session('success'))
            <div id="flash-success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-4 rounded-lg mb-6 text-center font-medium shadow transition-opacity duration-500">
                ✅ Your message has been sent successfully. Thank you for contacting us!
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('contact') }}" method="POST">
            @csrf
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                <input type="text" id="name" name="name"
                       class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none"
                       placeholder="Full Name" required>
            </div>

            <div class="mt-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" id="email" name="email"
                       class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none"
                       placeholder="email@example.com" required>
            </div>

            <div class="mt-4">
                <label for="subject" class="block text-sm font-semibold text-gray-700">Subject</label>
                <input type="text" id="subject" name="subject"
                       class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none"
                       placeholder="e.g. Product Inquiry">
            </div>

            <div class="mt-4">
                <label for="message" class="block text-sm font-semibold text-gray-700">Message</label>
                <textarea id="message" name="message" rows="5"
                          class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none"
                          placeholder="Write your message here..." required></textarea>
            </div>

            <div class="text-right mt-6">
                <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-lg font-medium shadow hover:shadow-lg transition hover:brightness-110">
                    Send Message
                </button>
            </div>
        </form>

        <!-- Contact Info -->
        <div class="mt-10 text-center text-gray-600 text-sm space-y-1">
            <p><strong>Email:</strong> merdekaflower@gmail.com</p> 
            <p><strong>Phone:</strong> +62 858-8048-1295</p> 
            <p><strong>Address:</strong> Jl. Merdeka, Abadijaya, Sukmajaya District, Depok City, West Java 16417</p>
        </div>
    </div>

    <!-- Auto-hide flash message -->
    <script>
        setTimeout(function () {
            const alert = document.getElementById('flash-success');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 4000);
    </script>
</body>
</html>
