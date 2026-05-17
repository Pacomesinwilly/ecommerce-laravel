<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique — Pacôme SINWILLY</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #0A0A0A; color: #E8E8E8; font-family: system-ui, sans-serif; }
        nav { background: #111; border-bottom: 1px solid #1f1f1f; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        nav .logo { color: #F97316; font-size: 1.2rem; font-weight: 700; }
        nav .links a { color: #888; text-decoration: none; margin-left: 1.5rem; font-size: 0.9rem; }
        nav .links a:hover { color: #F97316; }
        .container { max-width: 1100px; margin: 0 auto; padding: 2rem; }
        h1 { font-size: 2rem; color: #E8E8E8; margin-bottom: 0.5rem; }
        .subtitle { color: #555; margin-bottom: 2rem; font-size: 0.9rem; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.25rem; }
        .card { background: #111; border: 1px solid #1f1f1f; border-radius: 12px; padding: 1.5rem; }
        .card h3 { color: #E8E8E8; margin-bottom: 0.5rem; }
        .card p { color: #666; font-size: 0.85rem; margin-bottom: 1rem; line-height: 1.6; }
        .price { color: #F97316; font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem; }
        .btn { background: #F97316; color: #fff; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-size: 0.85rem; text-decoration: none; display: inline-block; }
        .btn-outline { background: transparent; border: 1px solid #2a2a2a; color: #888; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-size: 0.85rem; text-decoration: none; display: inline-block; margin-left: 0.5rem; }
        .empty { text-align: center; padding: 4rem; color: #444; }
        .empty p { font-size: 1.1rem; margin-bottom: 1rem; }
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.85rem; }
        .alert-success { background: #22C55E20; border: 1px solid #22C55E40; color: #22C55E; }
        .badge { font-size: 0.7rem; padding: 2px 8px; border-radius: 20px; background: #1a1a1a; color: #888; border: 1px solid #2a2a2a; }
    </style>
</head>
<body>
    <nav>
        <span class="logo">PS. Boutique</span>
        <div class="links">
            <a href="{{ route('products.index') }}">Produits</a>
            @auth
                <a href="{{ route('cart.index') }}">🛒 Panier</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:#888;cursor:pointer;font-size:0.9rem;margin-left:1.5rem">Déconnexion</button>
                </form>
            @else
                <a href="{{ route('login') }}">Connexion</a>
                <a href="{{ route('register') }}">Inscription</a>
            @endauth
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h1>Nos Produits</h1>
        <p class="subtitle">Découvrez notre sélection — E-commerce Laravel par Pacôme SINWILLY</p>

        @if($products->count() > 0)
            <div class="grid">
                @foreach($products as $product)
                <div class="card">
                    <span class="badge">{{ $product->category ?? 'Général' }}</span>
                    <h3 style="margin-top:0.75rem">{{ $product->name }}</h3>
                    <p>{{ $product->description ?? 'Aucune description disponible.' }}</p>
                    <div class="price">{{ number_format($product->price, 0, ',', ' ') }} FCFA</div>
                    <p style="font-size:0.75rem;color:#555;margin-bottom:1rem">Stock : {{ $product->stock }}</p>
                    @auth
                        <form method="POST" action="{{ route('cart.add', $product) }}" style="display:inline">
                            @csrf
                            <button type="submit" class="btn">Ajouter au panier</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn">Acheter</a>
                    @endauth
                    <a href="{{ route('products.show', $product) }}" class="btn-outline">Détails</a>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty">
                <p>Aucun produit disponible pour le moment.</p>
                @auth
                    <p style="color:#555;font-size:0.85rem">Connecté en tant que {{ auth()->user()->name }}</p>
                @endauth
            </div>
        @endif
    </div>
</body>
</html>