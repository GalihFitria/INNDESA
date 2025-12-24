<!-- Floating Chatbot Button + Modal -->
<div id="chatbot-container" class="fixed bottom-6 right-6 z-50">
    <!-- Tombol Chat -->
    <button id="openChat"
        class="bg-blue-600 hover:bg-blue-700 text-white font-bold p-4 rounded-full shadow-lg transition-all duration-300 transform hover:scale-110">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>

    <!-- Kotak Chat -->
    <div id="chatBox"
        class="hidden bg-white w-80 h-96 rounded-2xl shadow-2xl border border-gray-100 flex flex-col overflow-hidden">
        <div class="bg-blue-600 text-white p-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div>
                    <span class="font-bold text-lg">Asisten INNDESA</span>
                    <div class="text-xs opacity-90 flex items-center gap-1">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        Online
                    </div>
                </div>
            </div>
            <button id="closeChat" class="text-white hover:bg-indigo-700 rounded-full p-1 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div id="chatMessages" class="flex-1 p-4 overflow-y-auto text-sm space-y-3 bg-gray-50">
            <!-- Pesan pembuka akan ditambahkan di sini oleh JS -->
        </div>

        <form id="chatForm" class="p-3 border-t border-gray-200 bg-white flex gap-2">
            <input type="text" id="userInput" name="message" placeholder="Tulis pesan..."
                class="flex-1 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full transition-all duration-300 transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openBtn = document.getElementById('openChat');
        const closeBtn = document.getElementById('closeChat');
        const chatBox = document.getElementById('chatBox');
        const form = document.getElementById('chatForm');
        const input = document.getElementById('userInput');
        const messagesContainer = document.getElementById('chatMessages');

        // Fungsi untuk menambahkan pesan ke kotak chat
        function addMessage(sender, text) {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('flex', sender === 'user' ? 'justify-end' : 'justify-start', 'mb-3');

            if (sender === 'user') {
                const span = document.createElement('span');
                span.classList.add('bg-indigo-600', 'text-white', 'p-3', 'rounded-2xl', 'rounded-br-none', 'inline-block', 'max-w-[80%]', 'shadow-md');
                span.innerHTML = text;
                messageDiv.appendChild(span);
            } else {
                // Container untuk pesan bot dengan logo
                const botContainer = document.createElement('div');
                botContainer.classList.add('flex', 'gap-2', 'max-w-[80%]');

                // Logo untuk pesan bot
                const logoImg = document.createElement('img');
                logoImg.src = "{{ asset('images/logo.png') }}";
                logoImg.alt = "Logo INNDESA";
                logoImg.classList.add('w-8', 'h-8', 'rounded-full', 'flex-shrink-0');

                // Container untuk pesan teks bot
                const textContainer = document.createElement('div');
                textContainer.classList.add('flex', 'flex-col');

                // Nama bot
                const botName = document.createElement('div');
                botName.classList.add('text-xs', 'text-gray-500', 'mb-1', 'ml-1');
                botName.textContent = 'Asisten INNDESA';

                // Pesan bot
                const span = document.createElement('span');
                span.classList.add('bg-white', 'text-gray-800', 'p-3', 'rounded-2xl', 'rounded-bl-none', 'inline-block', 'shadow-md', 'border', 'border-gray-200');
                span.innerHTML = text;

                textContainer.appendChild(botName);
                textContainer.appendChild(span);
                botContainer.appendChild(logoImg);
                botContainer.appendChild(textContainer);
                messageDiv.appendChild(botContainer);
            }

            messagesContainer.appendChild(messageDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Fungsi untuk menampilkan indikator "sedang mengetik..."
        function showTypingIndicator() {
            const typingDiv = document.createElement('div');
            typingDiv.id = 'typingIndicator';
            typingDiv.classList.add('flex', 'justify-start', 'mb-3');

            // Container untuk indikator mengetik dengan logo
            const botContainer = document.createElement('div');
            botContainer.classList.add('flex', 'gap-2');

            // Logo untuk indikator mengetik
            const logoImg = document.createElement('img');
            logoImg.src = "{{ asset('images/logo.png') }}";
            logoImg.alt = "Logo INNDESA";
            logoImg.classList.add('w-8', 'h-8', 'rounded-full', 'flex-shrink-0');

            // Container untuk indikator teks
            const textContainer = document.createElement('div');
            textContainer.classList.add('flex', 'flex-col');

            // Nama bot
            const botName = document.createElement('div');
            botName.classList.add('text-xs', 'text-gray-500', 'mb-1', 'ml-1');
            botName.textContent = 'Asisten INNDESA';

            // Indikator mengetik
            const typingBubble = document.createElement('span');
            typingBubble.classList.add('bg-white', 'text-gray-500', 'p-3', 'rounded-2xl', 'rounded-bl-none', 'inline-block', 'shadow-md', 'border', 'border-gray-200');
            typingBubble.innerHTML = '<div class="flex space-x-1"><div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0ms;"></div><div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 150ms;"></div><div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 300ms;"></div></div>';

            textContainer.appendChild(botName);
            textContainer.appendChild(typingBubble);
            botContainer.appendChild(logoImg);
            botContainer.appendChild(textContainer);
            typingDiv.appendChild(botContainer);

            messagesContainer.appendChild(typingDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function hideTypingIndicator() {
            const indicator = document.getElementById('typingIndicator');
            if (indicator) {
                indicator.remove();
            }
        }

        openBtn.onclick = () => {
            chatBox.classList.remove('hidden');
            openBtn.classList.add('hidden');
            // Tambahkan pesan pembuka hanya saat pertama kali dibuka
            if (messagesContainer.children.length === 0) {
                addMessage('bot', 'Halo! Ada yang bisa saya bantu terkait produk, kegiatan, atau kelompok kami?');
            }
        };

        closeBtn.onclick = () => {
            chatBox.classList.add('hidden');
            openBtn.classList.remove('hidden');
        };

        form.onsubmit = async (e) => {
            e.preventDefault();
            const userMsg = input.value.trim();
            if (!userMsg) return;

            addMessage('user', userMsg);
            input.value = '';
            showTypingIndicator();

            try {
                const res = await fetch("{{ route('chat.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        message: userMsg
                    })
                });

                if (!res.ok) throw new Error('Network response was not ok.');

                const data = await res.json();
                hideTypingIndicator();
                addMessage('bot', data.reply);

            } catch (error) {
                console.error('Error:', error);
                hideTypingIndicator();
                addMessage('bot', 'Maaf, terjadi kesalahan. Silakan coba lagi nanti.');
            }
        };
    });
</script>