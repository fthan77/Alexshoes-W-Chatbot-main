from fastapi import FastAPI
from pydantic import BaseModel
import subprocess

app = FastAPI()

# =========================
# NORMALIZATION
# =========================
def normalize(text: str) -> str:
    return text.lower().strip()

# =========================
# INTENT KEYWORDS
# =========================
INTENTS = {
    "sapaan": ["halo", "hai", "hi", "permisi"],
    "layanan": ["layanan", "jasa", "treatment", "service", "cuci"],
    "alur": ["alur", "proses", "tahapan", "cara"],
    "harga": ["harga", "biaya", "tarif"],
    "lokasi": ["lokasi", "alamat", "dimana"],
    "jam": ["jam", "buka", "operasional"],
    "kontak": ["kontak", "wa", "whatsapp", "admin"],
    "estimasi": ["lama", "berapa hari", "estimasi"],
    "deep_cleaning": ["deep cleaning", "deepclean"],
    "profil_usaha": ["profil usaha", "tentang", "about"],
    "penjelasan_layanan": ["bagaimana", "cara kerja", "penjelasan", "bekerja"],
}

# =========================
# DETECT INTENT
# =========================
def detect_intent(user_input: str):
    text = normalize(user_input)
    for intent, keywords in INTENTS.items():
        for kw in keywords:
            if kw in text:
                return intent
    return None

# =========================
# SERVICE EXPLANATION DETECTOR 
# =========================
def is_service_explanation(text: str) -> bool:
    services = ["fast cleaning", "deep cleaning", "unyellowing", "repaint"]
    triggers = ["bagaimana", "cara kerja", "penjelasan", "bekerja"]

    text = normalize(text)
    return any(svc in text for svc in services) and any(t in text for t in triggers)

# =========================
# LLaMA (OLLAMA) CALL
# =========================
def ask_llama_service_explanation(question: str) -> str:
    prompt = f"""
Kamu adalah Tanya Alex, asisten virtual resmi dari Alex Shoes.

ATURAN WAJIB:
- Jawab hanya seputar layanan cuci sepatu Alex Shoes
- Jangan menyebut brand lain
- Jangan mengarang di luar konteks
- Gunakan bahasa Indonesia yang ramah dan mudah dipahami
- Jika ragu, arahkan pelanggan ke admin

INFORMASI TETAP:
Alex Shoes menyediakan layanan:
- Fast Cleaning
- Deep Cleaning
- Repaint
- Unyellowing

Unyellowing adalah proses untuk menghilangkan warna kuning pada midsole sepatu
menggunakan cairan dan teknik khusus agar warna sepatu kembali cerah
tanpa merusak material.

PERTANYAAN PELANGGAN:
{question}

JAWABAN:
"""

    result = subprocess.run(
        ["ollama", "run", "llama3.2:3b"],
        input=prompt,
        text=True,
        capture_output=True
    )

    return result.stdout.strip()

# =========================
# FINAL ANSWERS (LOCKED FAQ)
# =========================
INTENT_ANSWERS = {
    "sapaan": (
        "Halo! Saya Tanya Alex 👟\n"
        "Asisten virtual dari Alex Shoes.\n"
        "Ada yang bisa saya bantu seputar layanan cuci sepatu?"
    ),

    "layanan": (
        "Alex Shoes menyediakan layanan cuci sepatu berikut:\n"
        "• Fast Cleaning\n"
        "• Deep Cleaning\n"
        "• Repaint\n"
        "• Unyellowing"
    ),

    "alur": (
        "Alur layanan cuci sepatu di Alex Shoes:\n"
        "1. Sepatu diterima dari pelanggan\n"
        "2. Sepatu dicatat dan dicek kondisinya\n"
        "3. Penentuan treatment yang sesuai\n"
        "4. Proses pencucian sesuai standar\n"
        "5. Quality control\n"
        "6. Sepatu dikembalikan ke pelanggan"
    ),

    "harga": (
        "Harga layanan Alex Shoes berkisar antara Rp35.000 – Rp100.000.\n"
        "Harga tergantung jenis treatment, bahan sepatu, dan tingkat kekotoran.\n"
        "Untuk harga pasti, silakan hubungi admin WhatsApp 0812-3456-7890."
    ),

    "lokasi": (
        "Alex Shoes berlokasi di Jalan Belibis Terusan, Jakarta Barat.\n"
        "Alex Shoes hanya memiliki satu lokasi dan tidak memiliki cabang."
    ),

    "jam": "Alex Shoes buka setiap hari pukul 09.00 – 20.00 WIB.",

    "kontak": "WhatsApp admin Alex Shoes: 0812-3456-7890",

    "estimasi": "Estimasi pengerjaan sepatu adalah 2 – 4 hari tergantung kondisi sepatu.",

    "deep_cleaning": (
        "Ya, Alex Shoes menerima layanan Deep Cleaning untuk semua jenis sepatu."
    ),

    "profil_usaha": (
        "Alex Shoes adalah jasa cuci sepatu profesional yang berlokasi di "
        "Jalan Belibis Terusan, Jakarta Barat."
    ),
}

# =========================
# REQUEST BODY
# =========================
class ChatRequest(BaseModel):
    message: str

# =========================
# CHAT ENDPOINT (FINAL)
# =========================
@app.post("/chat")
def chat_endpoint(req: ChatRequest):
    user_input = req.message

    # =========================
    # 1. PRIORITAS UTAMA
    # Penjelasan layanan spesifik → LLaMA
    # =========================
    if is_service_explanation(user_input):
        return {
            "reply": ask_llama_service_explanation(user_input)
        }

    # =========================
    # 2. JAWABAN PASTI (FAQ / RULE-BASED)
    # =========================
    intent = detect_intent(user_input)
    if intent and intent in INTENT_ANSWERS:
        return {
            "reply": INTENT_ANSWERS[intent]
        }

    # =========================
    # 3. FALLBACK AMAN
    # =========================
    return {
        "reply": (
            "Maaf, Tanya Alex belum bisa memastikan maksud pertanyaan kamu.\n"
            "Kamu bisa menanyakan seputar layanan, harga, alur, atau lokasi Alex Shoes ya 👟"
            "Jika ada pertanyaan Lain, silakan hubungi admin kami di WhatsApp 0812-3456-7890"
        )
    }
