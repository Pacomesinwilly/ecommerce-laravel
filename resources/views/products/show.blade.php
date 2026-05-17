<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} — Boutique</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #0A0A0A; color: #E8E8E8; font-family: system-ui, sans-serif; }
        nav { background: #111; border-bottom: 1px solid #1f1f1f; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        nav .logo { color: #F97316; font-size: 1.2rem; font-weight: 700; }
        nav .links a { color: #888; text-decoration: none; margin-left: 1.5rem; font-size: 0.9rem; }
        .container { max-width: 800px; margin: 3rem auto; padding: 0 2rem; }
        .card { background: #111; border: 1px solid #1f1f1f; border-radius: 16px; padding: 2rem; }
        .price { color: #F97316; font-size: 1.5rem; font-weight: 700; margin: 1rem 0; }
        .btn { background: #F97316; color: #fff; border: none; padding: 12px 24px; border-radius: 6px; cursor: pointer; font-size: 0.9rem; text-decoration: none; display: inline-block; }
        .btn-back { color: #888; text-decoration: none; font-size: 0.85rem; display: inline-block; margin-bottom: 1.5rem; }
        .btn-back:hover { color: #F97316; }
    </style>
</head>
<body>
    <nav>
        <span class="logo">PS. Boutique</span>
        <div class="links">
            <a href="{{ route('products.index') }}">Produits</a>
        </div>
    </nav>
    <div class="container">
        <a href="{{ route('products.index') }}" class="btn-back">← Retour aux produits</a>
        <div class="card">
            <h1 style="font-size:1.8rem;margin-bottom:0.5rem">{{ $product->name }}</h1>
            <p style="color:#555;font-size:0.8rem;margin-bottom:1rem">Catégorie : {{ $product->category ?? 'Général' }}</p>
            <p style="color:#888;line-height:1.8;margin-bottom:1rem">{{ $product->description ?? 'Aucune description.' }}</p>
            <div class="price">{{ number_format($product->price, 0, ',', ' ') }} FCFA</div>
            <p style="color:#555;font-size:0.85rem;margin-bottom:1.5rem">Stock disponible : {{ $product->stock }}</p>
            @auth
                <form method="POST" action="{{ route('cart.add', $product) }}">
                    @csrf
                    <button type="submit" class="btn">Ajouter au panier</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn">Se connecter pour acheter</a>
            @endauth
        </div>
    </div>
</body>
</html>