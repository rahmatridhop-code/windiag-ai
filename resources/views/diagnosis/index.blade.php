<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WinDiag.AI - Sistem Pakar BSOD (Laravel)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { background-color: #0B0F19; color: #F8FAFC; font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .glass-card { background: rgba(19, 26, 43, 0.85); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.08); }
        .gradient-text { background: linear-gradient(135deg, #EC4899 0%, #8B5CF6 50%, #06B6D4 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-pink-500 selection:text-white">

    <!-- Navbar -->
    <nav class="border-b border-slate-800/80 bg-[#0B0F19]/90 sticky top-0 z-50 backdrop-blur-md">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-tr from-pink-500 to-purple-600 flex items-center justify-center shadow-lg shadow-pink-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <span class="font-bold text-lg tracking-tight text-white">WinDiag<span class="text-pink-500">.AI</span></span>
                    <span class="hidden sm:inline-block ml-2 text-xs px-2 py-0.5 rounded-full bg-purple-500/10 text-purple-400 border border-purple-500/20 font-mono">Laravel • Certainty Factor</span>
                </div>
            </div>
            <div class="flex space-x-2 sm:space-x-4">
                <button onclick="switchTab('beranda')" id="nav-beranda" class="nav-btn px-3 py-1.5 rounded-lg text-sm font-medium transition">Beranda</button>
                <button onclick="switchTab('konsultasi')" id="nav-konsultasi" class="nav-btn px-3 py-1.5 rounded-lg text-sm font-medium transition">Mulai Diagnosa</button>
                <button onclick="switchTab('basis-pengetahuan')" id="nav-basis-pengetahuan" class="nav-btn px-3 py-1.5 rounded-lg text-sm font-medium transition">Knowledge Base</button>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <main class="flex-grow max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- SECTION 1: BERANDA -->
        <section id="tab-beranda" class="tab-content space-y-8">
            <div class="glass-card rounded-2xl p-8 sm:p-12 text-center relative overflow-hidden">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-pink-600/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-purple-600/20 rounded-full blur-3xl"></div>
                
                <span class="inline-block px-3 py-1 rounded-full text-xs font-mono bg-slate-800 text-cyan-400 border border-slate-700 mb-4">
                    PROYEK MATA KULIAH KECERDASAN BUATAN (AI)
                </span>
                <h1 class="text-3xl sm:text-5xl font-bold tracking-tight text-white mb-4 leading-tight">
                    Sistem Pakar Diagnosa <span class="gradient-text">BSOD & Kegagalan Booting</span> Windows
                </h1>
                <p class="max-w-2xl mx-auto text-slate-400 text-base sm:text-lg mb-8">
                    Identifikasi akar permasalahan kerusakan perangkat keras dan konflik sistem operasi Windows menggunakan arsitektur Laravel MVC dan metode <strong class="text-slate-200">Certainty Factor (CF)</strong>.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <button onclick="switchTab('konsultasi')" class="px-6 py-3.5 rounded-xl bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-500 hover:to-purple-500 text-white font-semibold shadow-lg shadow-pink-600/25 transition flex items-center justify-center gap-2">
                        <span>Mulai Diagnosa Sekarang</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </button>
                    <button onclick="switchTab('basis-pengetahuan')" class="px-6 py-3.5 rounded-xl bg-slate-800/80 hover:bg-slate-800 text-slate-200 font-medium border border-slate-700 transition">
                        Lihat Matriks Rules & CF
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="glass-card rounded-xl p-6">
                    <div class="w-10 h-10 rounded-lg bg-pink-500/10 border border-pink-500/20 flex items-center justify-center text-pink-400 mb-4 font-mono font-bold">01</div>
                    <h3 class="text-lg font-semibold text-white mb-2">Analisis Bug Check Code</h3>
                    <p class="text-sm text-slate-400">Mencocokkan kode henti spesifik Windows seperti <code class="text-pink-400">MEMORY_MANAGEMENT</code> dan <code class="text-pink-400">INACCESSIBLE_BOOT_DEVICE</code>.</p>
                </div>
                <div class="glass-card rounded-xl p-6">
                    <div class="w-10 h-10 rounded-lg bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400 mb-4 font-mono font-bold">02</div>
                    <h3 class="text-lg font-semibold text-white mb-2">Metode Certainty Factor</h3>
                    <p class="text-sm text-slate-400">Menghitung kombinasi bobot keyakinan pakar ($CF_{pakar}$) dan keyakinan pengguna ($CF_{user}$) di sisi server Laravel.</p>
                </div>
                <div class="glass-card rounded-xl p-6">
                    <div class="w-10 h-10 rounded-lg bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 mb-4 font-mono font-bold">03</div>
                    <h3 class="text-lg font-semibold text-white mb-2">Transparansi Inferensi</h3>
                    <p class="text-sm text-slate-400">Menampilkan rincian proses kalkulasi matematis di balik setiap hasil diagnosa beserta langkah perbaikan teknis.</p>
                </div>
            </div>
        </section>

        <!-- SECTION 2: KONSULTASI / DIAGNOSA -->
        <section id="tab-konsultasi" class="tab-content hidden space-y-6">

            @if(isset($error))
                <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
                    {{ $error }}
                </div>
            @endif

            <!-- HASIL INFERENSI (Muncul setelah form disubmit) -->
            @if(isset($results) && count($results) > 0)
                @php $top = $results[0]; @endphp
                <div id="result-section" class="glass-card rounded-2xl p-6 sm:p-8 border-pink-500/40 space-y-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-pink-500 animate-pulse"></span>
                            Hasil Inferensi Sistem Pakar
                        </h3>
                        <span class="text-xs font-mono text-slate-400">Engine: Laravel Forward Chaining + CF</span>
                    </div>

                    <div class="p-6 rounded-xl bg-gradient-to-br from-pink-500/15 via-purple-500/10 to-slate-900 border border-pink-500/40">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                            <div>
                                <span class="text-xs font-mono uppercase tracking-wider text-pink-400">Diagnosa Utama ({{ $top['code'] }} • {{ $top['category'] }})</span>
                                <h4 class="text-2xl font-bold text-white mt-1">{{ $top['name'] }}</h4>
                            </div>
                            <div class="text-left sm:text-right bg-slate-950/60 px-4 py-2 rounded-xl border border-pink-500/30">
                                <span class="text-xs text-slate-400 block">Tingkat Kepastian</span>
                                <span class="text-3xl font-bold font-mono text-pink-400">{{ $top['percentage'] }}%</span>
                            </div>
                        </div>

                        <div class="bg-slate-950/50 rounded-lg p-4 border border-slate-800 mb-4">
                            <h5 class="text-sm font-semibold text-cyan-400 mb-2">Rekomendasi Langkah Perbaikan:</h5>
                            <div class="text-sm text-slate-300 leading-relaxed">{!! $top['solution'] !!}</div>
                        </div>

                        <details open class="text-xs text-slate-400 bg-slate-900/80 rounded-lg p-3 border border-slate-800">
                            <summary class="cursor-pointer font-mono text-purple-400 hover:text-purple-300 font-semibold">Rincian Perhitungan Matematis CF</summary>
                            <ul class="mt-2 space-y-1 font-mono text-slate-300 pl-4 list-disc">
                                @foreach($top['steps'] as $step)
                                    <li>{{ $step }}</li>
                                @endforeach
                                <li class="text-pink-400 font-bold">Persentase Akhir = {{ number_format($top['cf_final'], 4) }} × 100% = {{ $top['percentage'] }}%</li>
                            </ul>
                        </details>
                    </div>

                    @if(count($results) > 1)
                        <div class="space-y-2">
                            <h5 class="text-sm font-semibold text-slate-400">Kemungkinan Kerusakan Lainnya:</h5>
                            @foreach(array_slice($results, 1) as $item)
                                <div class="p-4 rounded-xl bg-slate-900/60 border border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                    <div>
                                        <span class="text-xs font-mono text-purple-400">[{{ $item['code'] }}]</span>
                                        <span class="text-sm font-medium text-slate-200 ml-1">{{ $item['name'] }}</span>
                                    </div>
                                    <span class="font-mono text-sm font-bold text-slate-300">{{ $item['percentage'] }}%</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <!-- FORM KUESIONER GEJALA -->
            <form action="{{ route('diagnosis.analyze') }}" method="POST" class="glass-card rounded-2xl p-6 sm:p-8">
                @csrf
                <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-800 pb-4 mb-6 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Kuesioner Gejala Sistem</h2>
                        <p class="text-sm text-slate-400 mt-1">Pilih tingkat keyakinan Anda pada setiap gejala yang muncul.</p>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" onclick="isiContohKasus()" class="px-3 py-2 rounded-lg text-xs font-medium bg-cyan-500/10 text-cyan-400 border border-cyan-500/30 hover:bg-cyan-500/20 transition">
                            Isi Simulasi Kasus (Demo)
                        </button>
                        <a href="{{ route('diagnosis.index') }}" class="px-3 py-2 rounded-lg text-xs font-medium bg-slate-800 text-slate-300 border border-slate-700 hover:bg-slate-700 transition">
                            Reset Pilihan
                        </a>
                    </div>
                </div>

                <div class="space-y-3">
                    @foreach($symptoms as $symptom)
                        @php $selectedVal = $selectedSymptoms[$symptom->id] ?? 0; @endphp
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 rounded-xl bg-slate-900/60 border border-slate-800 hover:border-slate-700 transition gap-3">
                            <div class="flex items-start gap-3">
                                <span class="px-2 py-1 rounded text-xs font-mono font-semibold bg-pink-500/10 text-pink-400 border border-pink-500/20 mt-0.5">{{ $symptom->code }}</span>
                                <span class="text-sm text-slate-200 leading-relaxed">{{ $symptom->description }}</span>
                            </div>
                            <select name="symptoms[{{ $symptom->id }}]" data-code="{{ $symptom->code }}" class="symptom-select bg-slate-800 border border-slate-700 text-slate-200 text-xs sm:text-sm rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:outline-none sm:w-48 shrink-0">
                                <option value="0" {{ $selectedVal == 0 ? 'selected' : '' }}>Tidak Mengalami (0)</option>
                                <option value="0.4" {{ $selectedVal == 0.4 ? 'selected' : '' }}>Ragu-ragu (0.4)</option>
                                <option value="0.6" {{ $selectedVal == 0.6 ? 'selected' : '' }}>Cukup Yakin (0.6)</option>
                                <option value="0.8" {{ $selectedVal == 0.8 ? 'selected' : '' }}>Yakin (0.8)</option>
                                <option value="1.0" {{ $selectedVal == 1.0 ? 'selected' : '' }}>Sangat Yakin (1.0)</option>
                            </select>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 pt-6 border-t border-slate-800 flex justify-end">
                    <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-500 hover:to-purple-500 text-white font-semibold shadow-lg shadow-pink-600/25 transition">
                        Proses Analisis & Hitung CF
                    </button>
                </div>
            </form>
        </section>

        <!-- SECTION 3: BASIS PENGETAHUAN -->
        <section id="tab-basis-pengetahuan" class="tab-content hidden space-y-6">
            <div class="glass-card rounded-2xl p-6 sm:p-8">
                <h2 class="text-2xl font-bold text-white mb-2">Basis Pengetahuan & Aturan (Database MySQL)</h2>
                <p class="text-sm text-slate-400 mb-6">Data hipotesis kerusakan, kode gejala, dan bobot keyakinan pakar ($CF_{pakar}$) yang diambil langsung dari tabel database Laravel.</p>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-700 text-xs font-mono uppercase text-slate-400 bg-slate-900/50">
                                <th class="p-3">Kode</th>
                                <th class="p-3">Gejala / Indikasi Teknis</th>
                                <th class="p-3">Hipotesis Kerusakan</th>
                                <th class="p-3 text-center">CF Pakar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 text-sm">
                            @foreach($rules as $rule)
                                <tr class="hover:bg-slate-800/40">
                                    <td class="p-3 font-mono text-pink-400 font-semibold">{{ $rule->symptom->code }}</td>
                                    <td class="p-3 text-slate-300">{{ $rule->symptom->description }}</td>
                                    <td class="p-3 text-slate-400"><span class="text-purple-400 font-mono">[{{ $rule->hypothesis->code }}]</span> {{ $rule->hypothesis->name }}</td>
                                    <td class="p-3 text-center font-mono text-cyan-400 font-semibold">{{ number_format($rule->cf_pakar, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </main>

    <footer class="border-t border-slate-800/80 py-6 text-center text-xs text-slate-500">
        Sistem Pakar Diagnosa BSOD & Kegagalan Booting Windows • Laravel & Certainty Factor • Teknik Komputer
    </footer>

    <script>
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById(`tab-${tabName}`).classList.remove('hidden');

            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.className = "nav-btn px-3 py-1.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white transition";
            });
            document.getElementById(`nav-${tabName}`).className = "nav-btn px-3 py-1.5 rounded-lg text-sm font-medium bg-pink-500/10 text-pink-400 border border-pink-500/30 transition";
        }

        function isiContohKasus() {
            document.querySelectorAll('.symptom-select').forEach(sel => {
                const code = sel.getAttribute('data-code');
                if (code === 'G01') sel.value = "1.0";
                else if (code === 'G02') sel.value = "0.8";
                else if (code === 'G08') sel.value = "0.4";
                else sel.value = "0";
            });
        }

        // Buka tab sesuai status dari Controller
        switchTab("{{ $activeTab ?? 'beranda' }}");
    </script>
</body>
</html>