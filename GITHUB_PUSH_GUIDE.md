# 🚀 Panduan Push ke GitHub

## ⚠️ GitHub Autentikasi

GitHub tidak lagi mengizinkan password biasa. Anda perlu **Personal Access Token (PAT)**.

---

## 📋 Langkah-langkah Push ke GitHub

### 1️⃣ Generate Personal Access Token

1. **Buka GitHub** → Login ke akun Anda
2. **Settings** (Klik avatar → Settings)
3. **Developer settings** (di sidebar paling bawah)
4. **Personal access tokens** → **Tokens (classic)**
5. **Generate new token** → **Generate new token (classic)**

**Konfigurasi Token:**

-   **Note**: `ecommerce_project2`
-   **Expiration**: 90 days (atau sesuai kebutuhan)
-   **Select scopes**:
    -   ✅ `repo` (Full control of private repositories)
    -   ✅ `workflow` (Update GitHub Action workflows)

6. **Generate token**
7. **COPY TOKEN** (Anda tidak akan bisa melihatnya lagi!)

---

### 2️⃣ Push ke GitHub (Via Command Line)

```bash
# 1. Cek remote URL
git remote -v

# 2. Set remote URL (jika belum)
git remote set-url origin https://github.com/muris11/ecommerce_project2.git

# 3. Push ke branch api
git push origin api

# Saat diminta credentials:
# Username: muris11
# Password: [PASTE YOUR PERSONAL ACCESS TOKEN - BUKAN PASSWORD!]
```

---

### 3️⃣ Alternative: Cache Credentials

Agar tidak diminta credentials setiap kali:

#### Windows (Git Credential Manager)

```bash
# Git akan otomatis menyimpan token setelah input pertama kali
git config --global credential.helper wincred
git push origin api
# Input token sekali, selanjutnya otomatis
```

#### Windows (Manual via URL)

```bash
git remote set-url origin https://TOKEN@github.com/muris11/ecommerce_project2.git
# Ganti TOKEN dengan Personal Access Token Anda
git push origin api
```

#### Linux/Mac

```bash
git config --global credential.helper cache
# Token akan di-cache selama 15 menit
```

---

### 4️⃣ Push Multiple Branches

```bash
# Push branch api
git push origin api

# Push branch main (jika ada)
git push origin main

# Push all branches
git push --all origin

# Push tags (jika ada)
git push --tags origin
```

---

## 🔐 Security Tips

1. **JANGAN** commit token ke repository
2. **JANGAN** share token dengan orang lain
3. **GUNAKAN** expiration date untuk token
4. **REVOKE** token jika sudah tidak digunakan
5. **GENERATE** token baru jika token lama expired

---

## 📊 Verifikasi Push Berhasil

Setelah push berhasil, cek di GitHub:

1. Buka: https://github.com/muris11/ecommerce_project2
2. Pastikan branch `api` muncul
3. Lihat commit terbaru
4. Cek README.md sudah update

---

## 🔄 Workflow Git Setelah Push

### Pull Request (Merge api → main)

Jika ingin merge branch `api` ke `main`:

```bash
# Via GitHub Web:
1. Buka https://github.com/muris11/ecommerce_project2
2. Klik "Compare & pull request"
3. Base: main ← Compare: api
4. Create pull request
5. Merge pull request

# Via Command Line:
git checkout main
git pull origin main
git merge api
git push origin main
```

---

## 🐛 Troubleshooting

### Error: Authentication Failed

```
Solution: Generate Personal Access Token dan gunakan sebagai password
```

### Error: Permission Denied

```
Solution: Pastikan token memiliki scope 'repo'
```

### Error: Repository Not Found

```
Solution: Pastikan URL correct dan Anda punya akses ke repo
```

### Error: Updates were rejected

```bash
# Solution: Pull dulu, lalu push
git pull origin api --rebase
git push origin api
```

---

## 📝 Current Status

**Repository**: https://github.com/muris11/ecommerce_project2  
**Branch**: api  
**Commit**: Complete e-commerce platform with full features  
**Files Ready**: ✅ All files committed locally  
**Status**: ⏳ Waiting for push to GitHub

---

## ✅ Manual Push Instructions

**Karena authentication gagal otomatis, silakan push manual:**

```bash
# 1. Generate Personal Access Token di GitHub
#    Settings → Developer settings → Personal access tokens

# 2. Run push command
git push origin api

# 3. Saat diminta credentials:
#    Username: muris11
#    Password: [YOUR_PERSONAL_ACCESS_TOKEN]
```

**ATAU via GitHub Desktop:**

1. Download GitHub Desktop
2. File → Add Local Repository
3. Pilih folder: C:\laragon\www\ecommerce_project2
4. Publish branch
5. Login dengan GitHub account

---

## 🎉 Setelah Push Berhasil

1. ✅ Verifikasi di GitHub
2. ✅ Share repository link
3. ✅ Update documentation jika perlu
4. ✅ Create release tag (optional)
5. ✅ Setup GitHub Pages (optional)

---

**Support**: Jika masih ada masalah, bisa gunakan GitHub Desktop atau contact GitHub support.
