(() => {
    "use strict";

    const SAMPLE = `Dalam kehidupan suatu negara, pendidikan memegang peranan yang amat 
penting untuk menjamin kelangsungan hidup negara dan bangsa, karena pendidikan 
merupakan wahana untuk meningkatkan dan mengembangkan kualitas sumber daya 
manusia. Seiring dengan perkembangan teknologi komputer dan teknologi informasi, 
sekolah-sekolah di Indonesia sudah waktunya mengembangkan Sistem Informasi 
manajemennya agar mampu mengikuti perubahan jaman. 
SISKO mampu memberikan kemudahan pihak pengelola menjalankan 
kegiatannya dan meningkatkan kredibilitas dan akuntabilitas sekolah dimata siswa, 
orang tua siswa, dan masyakat umumnya.Penerapan teknologi informasi untuk 
menunjang proses pendidikan telah menjadi kebutuhan bagi lembaga pendidikan di 
Indonesia. Pemanfaatan teknologi informasi ini sangat dibutuhkan untuk 
meningkatkan efisiensi dan produktivitas bagi manajemen pendidikan. Keberhasilan 
dalam peningkatan efisiensi dan produktivitas bagi manajemen pendidikan akan ikut 
menentukan kelangsungan hidup lembaga pendidikan itu sendiri. Dengan kata lain 
menunda penerapan teknologi informasi dalam lembaga pendidikan berarti menunda 
kelancaran pendidikan dalam menghadapi persaingan global. 
Pemanfaatan teknologi informasi diperuntukkan bagi peningkatan kinerja 
lembaga pendidikan dalam upayanya meningkatkan kualitas Sumber Daya Manusia 
Indonesia. Guru dan pengurus sekolah tidak lagi disibukkan oleh pekerjaan-pekerjaan 
operasional, yang sesungguhnya dapat digantikan oleh komputer. Dengan demikian 
dapat memberikan keuntungan dalam efisien waktu dan tenaga. 
Penghematan waktu dan kecepatan penyajian informasi akibat penerapan 
teknologi informasi tersebut akan memberikan kesempatan kepada guru dan pengurus 
sekolah untuk meningkatkan kualitas komunikasi dan pembinaan kepada siswa. 
Dengan demikian siswa akan merasa lebih dimanusiakan dalam upaya 
mengembangkan kepribadian dan pengetahuannya. 
Sebagai contoh yang paling utama adalah sistem penjadwalan yang harus 
dilakukan setiap awal semester. Biasanya membutuhkan waktu lama untuk menyusun
penjadwalan, Dengan SISKO dapat selesai dalam waktu singkat. Untuk 
mempermudah bagian administrasi kurikulum sekolah, SISKO menyediakan fasilitas 
istimewa yang merupakan inti dari sistem kurikulum sekolah yaitu membantu dalam 
pembuatan penjadwalan mata pelajaran sekolah yang dapat diproses tidak lebih lama 
dari 10 menit. Administrator hanya akan memasukkan kondisi dari masing-masing 
guru yang akan mengajar baik itu dalam 1 minggu seorang guru dapat mengajar berapa 
jam, selain itu dapat juga melakukan pemesanan tempat dan penempatan hari libur 
masing-masing guru dalam 1 minggu masa mengajar. Setelah semua kondisi 
dimasukkan, sistem akan memproses semua data tersebut sehingga menghasilkan 
jadwal yang optimal dan dapat langsung dipakai karena sistem akan mendeteksi 
sehingga tidak akan ada jadwal yang bertumpukan satu dengan yang lainnya. 
Setelah semua kondisi dimasukkan, sistem akan memproses semua data 
tersebut sehingga menghasilkan jadwal yang optimal dan dapat langsung dipakai 
karena sistem akan mendeteksi sehingga tidak akan ada jadwal yang bertumpukan satu 
dengan yang lainnya. Setelah permasalahan penjadwalan dapat ditangani dengan baik, 
hal yang tidak kalah pentingnya adalah memasukkan data siswa. 
Program SISKO telah menyediakan fasilitas untuk penanganan penilaian 
siswa yang secara langsung memasukkan nilai ke dalam raport dan siap dicetak. Untuk 
sistem penilaian siswa, yang dapat melakukan pengisian hanya Guru yang mengajar 
mata pelajaran. Sistem penilaian telah disesuaikan dengan KBK sehingga masing
masing guru dapat memasukkan deskripsi narasi dari mata pelajaran. Untuk 
menampilkan data penilaian dapat disesuaikan kembali dengan kebijaksanaan dari 
masing-masing lembaga pendidikan apakah ingin menampilkan data nilai akhir siswa 
maupun menampilkan data nilai siswa setiap kali mengadakan test ataupun tugas 
tertentu. 
Selain Modul untuk penjadwalan dan Modul Penilaian siswa, SISKO juga 
memberikan fasilitas untuk bagian administrasi keuangan sekolah dalam hal 
pembayaran SPP siswa. Bagian administrasi dapat langsung mengecek siapa siswa 
yang mempunyai tunggakan SPP dan untuk detail histori pembayaran SPP dari 
masing-masing siswa dapat dicetak seperti mencetak buku tabungan di bank sehingga 
mempermudah pekerjaan pihak administrasi keuangan. Administrasi keuangan dapat 
langsung melakukan pengaturan data pembayaran masing-masing siswa sesuai 
dengan kebutuhan dan dapat diubah sewaktu-waktu apabila ada kenaikan pembayaran 
SPP. Apabila siswa tersebut akan melakukan pembayaran, petugas dapat langsung 
memasukkan data. Hal sama juga dapat dilakukan untuk Data pembayaran 
Sumbangan Sukarela dan Tabungan Karyawisata.`;

    // ---- utilities ----
    function escapeRegExp(s) {
        return s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    // Unicode-aware tokenizer: letters, numbers, apostrophe
    function tokenize(text) {
        const re = /[\p{L}\p{N}']+/gu;
        const out = [];
        let m;
        while ((m = re.exec(text)) !== null) out.push(m[0]);
        return out;
    }

    // Build ignore set from user input (comma or newline separated)
    function buildIgnoreSet(text) {
        if (!text) return new Set();
        return new Set(
            text
                .split(/[\n,]+/)
                .map(s => s.trim().toLowerCase())
                .filter(Boolean)
        );
    }

    function countWord(text, word) {
        if (!word) return 0;
        // whole-word using unicode-aware boundary (negative lookbehind/ahead)
        const pattern = new RegExp(`(?<![\\p{L}\\p{N}'])${escapeRegExp(word)}(?![\\p{L}\\p{N}'])`, 'giu');
        const matches = text.match(pattern);
        return matches ? matches.length : 0;
    }

    // Preserve-case function: handle ALL CAPS, lowercase, Title Case, First-letter
    function matchCase(replacement, original) {
        if (!original) return replacement;
        if (original.toUpperCase() === original) return replacement.toUpperCase();
        if (original.toLowerCase() === original) return replacement.toLowerCase();
        // Title case detection (Each word capitalized)
        const words = original.split(/(\s+)/);
        const isTitle = words.every(w => {
            if (!w || /\s+/.test(w)) return true;
            return w[0] === w[0].toUpperCase();
        });
        if (isTitle) {
            // Simple title-case the replacement
            return replacement.split(' ').map(p => p.charAt(0).toUpperCase() + p.slice(1)).join(' ');
        }
        // Default: match first char case
        if (original[0] === original[0].toUpperCase()) {
            return replacement.charAt(0).toUpperCase() + replacement.slice(1);
        }
        return replacement;
    }

    function replaceWord(text, oldWord, newWord, preserveCase = false) {
        if (!oldWord) return text;
        const re = new RegExp(`(?<![\\p{L}\\p{N}'])${escapeRegExp(oldWord)}(?![\\p{L}\\p{N}'])`, 'giu');
        if (!preserveCase) return text.replace(re, newWord);
        return text.replace(re, (match) => matchCase(newWord, match));
    }

    function sortedWords(text, mode = 'unique', ignoreSet = new Set()) {
        const toks = tokenize(text).map(t => t.toLowerCase()).filter(t => !ignoreSet.has(t));
        if (mode === 'all') return toks.sort((a, b) => a.localeCompare(b, 'id'));
        const uniq = Array.from(new Set(toks));
        return uniq.sort((a, b) => a.localeCompare(b, 'id'));
    }

    function wordFrequencies(text, ignoreSet = new Set()) {
        const map = new Map();
        for (const t of tokenize(text).map(t => t.toLowerCase())) {
            if (ignoreSet.has(t)) continue;
            map.set(t, (map.get(t) || 0) + 1);
        }
        return map;
    }

    // Download helper
    function downloadBlob(filename, content, mime = 'text/plain;charset=utf-8') {
        const blob = new Blob([content], { type: mime });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url; a.download = filename;
        document.body.appendChild(a);
        a.click();
        a.remove();
        URL.revokeObjectURL(url);
    }

    // ---- wiring to DOM ----
    document.addEventListener('DOMContentLoaded', () => {
        const ta = document.getElementById('article');
        const btnLoad = document.getElementById('load-article');
        const btnClear = document.getElementById('clear-article');
        const btnCopy = document.getElementById('copy-article');

        const inputCount = document.getElementById('count-word');
        const btnCount = document.getElementById('btn-count');
        const btnCountCtx = document.getElementById('btn-count-ctx');
        const countResult = document.getElementById('count-result');

        const repOld = document.getElementById('replace-old');
        const repNew = document.getElementById('replace-new');
        const preserve = document.getElementById('preserve-case');
        const btnReplace = document.getElementById('btn-replace');
        const replaceResult = document.getElementById('replace-result');
        const applyReplace = document.getElementById('apply-replace');
        const saveReplace = document.getElementById('save-replace');

        const sortMode = document.getElementById('sort-mode');
        const btnSort = document.getElementById('btn-sort');
        const sortResult = document.getElementById('sort-result');
        const btnTop = document.getElementById('btn-top');
        const topN = document.getElementById('top-n');
        const stopwordsEl = document.getElementById('stopwords');
        const downloadFreq = document.getElementById('download-freq');

        // set sample
        ta.value = SAMPLE;

        btnLoad.addEventListener('click', () => { ta.value = SAMPLE; ta.focus(); });
        btnClear.addEventListener('click', () => ta.value = '');
        btnCopy.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(ta.value);
                alert('Artikel disalin ke clipboard');
            } catch (e) {
                alert('Tidak bisa menyalin: ' + (e.message || e));
            }
        });

        btnCount.addEventListener('click', () => {
            const w = inputCount.value.trim();
            if (!w) { countResult.textContent = 'Masukkan kata untuk dicari.'; return; }
            const c = countWord(ta.value, w);
            countResult.textContent = `Jumlah kemunculan kata "${w}": ${c}`;
        });

        btnCountCtx.addEventListener('click', () => {
            const w = inputCount.value.trim();
            if (!w) { countResult.textContent = 'Masukkan kata untuk dicari.'; return; }
            const c = countWord(ta.value, w);
            const re = new RegExp(`(.{0,40})\\b${escapeRegExp(w)}\\b(.{0,40})`, 'giu');
            const matches = [];
            let m;
            while ((m = re.exec(ta.value)) !== null) {
                matches.push(`${m[1] || ''}${w}${m[2] || ''}`);
                if (matches.length >= 10) break;
            }
            const ctx = matches.map((s, i) => `${i + 1}. ...${s.trim()}...`).join('\n\n');
            countResult.textContent = `Jumlah: ${c}\n\nKonteks (max 10):\n${ctx || '(tidak ada konteks)'}`;
        });

        btnReplace.addEventListener('click', () => {
            const oldW = repOld.value.trim();
            const newW = repNew.value;
            if (!oldW) { replaceResult.textContent = 'Masukkan kata lama untuk diganti.'; return; }
            const out = replaceWord(ta.value, oldW, newW, preserve.checked);
            replaceResult.textContent = out.slice(0, 20000);
            if (!document.getElementById('replace-preview-only').checked) {
                ta.value = out;
            }
        });

        applyReplace.addEventListener('click', () => {
            const oldW = repOld.value.trim();
            const newW = repNew.value;
            if (!oldW) { alert('Masukkan kata lama untuk diganti'); return; }
            ta.value = replaceWord(ta.value, oldW, newW, preserve.checked);
            replaceResult.textContent = 'Terapkan: textarea diperbarui.';
        });

        saveReplace && saveReplace.addEventListener('click', () => {
            const content = replaceResult.textContent || '';
            downloadBlob('article_replaced.txt', content);
        });

        btnSort.addEventListener('click', () => {
            const mode = sortMode.value;
            const ignores = buildIgnoreSet(stopwordsEl.value);
            const arr = sortedWords(ta.value, mode, ignores);
            sortResult.textContent = arr.length ? arr.join(', ') : '(tidak ada kata ditemukan)';
        });

        btnTop.addEventListener('click', () => {
            const n = Math.max(1, parseInt(topN.value, 10) || 20);
            const ignores = buildIgnoreSet(stopwordsEl.value);
            const freqs = wordFrequencies(ta.value, ignores);
            const arr = Array.from(freqs.entries()).sort((a, b) => b[1] - a[1]).slice(0, n);
            sortResult.textContent = arr.map(([w, c]) => `${w}: ${c}`).join('\n') || '(tidak ada kata)';
        });

        downloadFreq.addEventListener('click', () => {
            const ignores = buildIgnoreSet(stopwordsEl.value);
            const freqs = wordFrequencies(ta.value, ignores);
            const arr = Array.from(freqs.entries()).sort((a, b) => b[1] - a[1]);
            let csv = 'word,count\n' + arr.map(([w, c]) => `${JSON.stringify(w).slice(1, -1)},${c}`).join('\n');
            downloadBlob('frequencies.csv', csv, 'text/csv;charset=utf-8');
        });

    });
})();