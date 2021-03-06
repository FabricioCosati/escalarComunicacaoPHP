@extends("layouts.main") @section("title", "Escalar Comunicação")
@section("content")

@auth
<form action="/" method="POST" enctype="multipart/form-data">
    @csrf
    <section class="section">
        <div class="table-container" id="table-container-tv">
            <div class="table-container-title">
                <h3>Tvs</h3>
            </div>

            <table class="table-container-content">
                <thead>
                    <tr>
                        <th>Quant.</th>
                        <th>Tvs</th>
                        <th>Valor Unitário</th>
                        <th>Valor total</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody id="tv-row-body">
                    @if($tvs) @foreach($tvs as $tv)
                    
                    <tr class="tv-row" id="tv-row-{{ $tv['id'] }}">
                        <input type="hidden" name="id_tv[]" value="{{ $tv['id'] }}" />
                        <td>
                            <div>
                                <input
                                    type="text"
                                    name="quantity_tv[]"
                                    class="quantity"
                                    value="{{ $tv['quantity'] }}"
                                />
                            </div>
                        </td>

                        <td>
                            <div>
                                <select name="tv[]" id="tv" class="tv">
                                    <option value="0" {{ ($tv["tv"]) == 0 ? 'selected' : '' }}>TV 32 polegadas</option>
                                    <option value="1" {{ ($tv["tv"]) == 1 ? 'selected' : '' }}>TV 40 polegadas</option>
                                    <option value="2" {{ ($tv["tv"]) == 2 ? 'selected' : '' }}>TV 43 polegadas</option>
                                    <option value="3" {{ ($tv["tv"]) == 3 ? 'selected' : '' }}>TV 49 polegadas</option>
                                    <option value="4" {{ ($tv["tv"]) == 4 ? 'selected' : '' }}>TV 50 polegadas</option>
                                    <option value="5" {{ ($tv["tv"]) == 5 ? 'selected' : '' }}>TV 55 polegadas</option>
                                    <option value="6" {{ ($tv["tv"]) == 6 ? 'selected' : '' }}>TV 58 polegadas</option>
                                    <option value="7" {{ ($tv["tv"]) == 7 ? 'selected' : '' }}>TV 65 polegadas</option>
                                    <option value="8" {{ ($tv["tv"]) == 8 ? 'selected' : '' }}>TV 75 polegadas</option>
                                    <option value="9" {{ ($tv["tv"]) == 9 ? 'selected' : '' }}>
                                        Monitor LFD(tamanho definido por
                                        projeto)
                                    </option>
                                    <option value="10" {{ ($tv["tv"]) == 10 ? 'selected' : '' }}>
                                        Monitor Video Wall
                                    </option>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                <input
                                    type="text"
                                    name="unitary_price_tv[]"
                                    class="unitary_price"
                                    value="{{number_format($tv['unitary_price'], 2, ",", ".")}}"
                                    onkeydown="add2decimals(event)"
                                />
                            </div>
                        </td>

                        <td>
                            <div>
                                <span
                                    name="product_total_price_tv[]"
                                    class="product_total_price"
                                >
                                {{number_format($tv['product_total_price'], 2, ",", ".")}}
                                </span>
                            </div>
                        </td>
                        <td>
                            <button type="button" class="remove-tv-row" onclick="removeTable(event)">X</button>
                        </td>
                    </tr>
                    @endforeach @else
                    <tr class="tv-row" id="tv-row-0">
                        <td>
                            <div>
                                <input
                                    type="number"
                                    name="quantity_tv[]"
                                    class="quantity"
                                    value="0"
                                />
                            </div>
                        </td>

                        <td>
                            <div>
                                <select name="tv[]" id="tv" class="tv">
                                    <option value="0">TV 32 polegadas</option>
                                    <option value="1">TV 40 polegadas</option>
                                    <option value="2">TV 43 polegadas</option>
                                    <option value="3">TV 49 polegadas</option>
                                    <option value="4">TV 50 polegadas</option>
                                    <option value="5">TV 55 polegadas</option>
                                    <option value="6">TV 58 polegadas</option>
                                    <option value="7">TV 65 polegadas</option>
                                    <option value="8">TV 75 polegadas</option>
                                    <option value="9">
                                        Monitor LFD(tamanho definido por
                                        projeto)
                                    </option>
                                    <option value="10">
                                        Monitor Video Wall
                                    </option>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                <input
                                    type="text"
                                    name="unitary_price_tv[]"
                                    
                                    class="unitary_price"
                                    onkeydown="add2decimals(event)"
                                    value="0,00"
                                />
                            </div>
                        </td>

                        <td>
                            <div>
                                <span
                                    name="product_total_price_tv[]"
                                    class="product_total_price"
                                >
                                0,00
                                </span>
                            </div>
                        </td>

                        <td>
                            <button type="button" class="remove-tv-row" onclick="removeTable('tv-row')">X</button>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>

            <div class="full-price">
                <h4>Total</h4>
                <p>R$ {{number_format($tvs_full_price, 2, ",", ".")}}</p>
                
            </div>

            <div class="button-container">
                <button
                    type="button"
                    class="add-tv-row"
                    onclick="addTable('tv-row')"
                    >
                    Adicionar Tvs
                </button>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="table-container" id="table-container-player">
            <div class="table-container-title">
                <h3>Players</h3>
            </div>

            <table class="table-container-content">
                <thead>
                    <tr>
                        <th>Quant.</th>
                        <th>Player</th>
                        <th>Valor Unitário</th>
                        <th>Valor total</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody id="player-row-body">
                    @if($players) @foreach($players as $player)
                    
                    <tr class="player-row" id="player-row-{{ $player['id'] }}">
                        <input type="hidden" name="id_player[]" value="{{ $player['id'] }}" />
                        <td>
                            <div>
                                <input
                                    type="text"
                                    name="quantity_player[]"
                                    class="quantity"
                                    value="{{ $player['quantity'] }}"
                                />
                            </div>
                        </td>

                        <td>
                            <div>
                                <select name="player[]" id="player" class="player">
                                    <option value="0" {{ ($player["player"]) == 0 ? 'selected' : '' }}>Player Alphasignage</option>
                                    <option value="1" {{ ($player["player"]) == 1 ? 'selected' : '' }}>Player Alphasignage Secundário</option>
                                    <option value="2" {{ ($player["player"]) == 2 ? 'selected' : '' }}>TV Box</option>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                <input
                                    type="text"
                                    name="unitary_price_player[]"
                                    
                                    class="unitary_price"
                                    value="{{number_format($player['unitary_price'], 2, ",", ".")}}"
                                    onkeydown="add2decimals(event)"
                                />
                            </div>
                        </td>

                        <td>
                            <div>
                                <span
                                    name="product_total_price_player[]"
                                    class="product_total_price" 
                                >
                                {{number_format($player['product_total_price'], 2, ",", ".")}}
                                </span>
                            </div>
                        </td>
                        <td>
                            <button type="button" class="remove-player-row" onclick="removeTable(event)">X</button>
                        </td>
                    </tr>
                    @endforeach @else
                    <tr class="player-row" id="player-row-0">
                        <td>
                            <div>
                                <input
                                    type="number"
                                    name="quantity_player[]"
                                    class="quantity"
                                    value="0"
                                />
                            </div>
                        </td>

                        <td>
                            <div>
                                <select name="player[]" id="player" class="player">
                                    <option value="0" >Player Alphasignage</option>
                                    <option value="1" >Player Alphasignage Secundário</option>
                                    <option value="2" >TV Box</option>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                <input
                                    type="text"
                                    name="unitary_price_player[]"
                                    
                                    class="unitary_price"
                                    onkeydown="add2decimals(event)"
                                    value="0,00"
                                />
                            </div>
                        </td>

                        <td>
                            <div>
                                <span
                                    name="product_total_price_player[]"
                                    class="product_total_price" 
                                >
                                0,00
                                </span>
                            </div>
                        </td>

                        <td>
                            <button type="button" class="remove-player-row" onclick="removeTable('player-row')">X</button>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>

            <div class="full-price">
                <h4>Total</h4>
                <p>R$ {{number_format($players_full_price, 2, ",", ".")}}</p>
            </div>

            <div class="button-container">
                <button
                    type="button"
                    class="add-player-row"
                    onclick="addTable('player-row')"
                >
                    Adicionar Players
                </button>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="table-container" id="table-container-labor">
            <div class="table-container-title" >
                <h3>Mão de obra</h3>
            </div>

            <table class="table-container-content">
                <thead>
                    <tr>
                        <th>Custo</th>
                    </tr>
                </thead>

                <tbody id="labor-row-body">
                    <tr class="labor-row" id="labor-row-0">
                        <td>
                            <div>
                                <input
                                    type="text"
                                    name="labor_price"
                                    id="labor_price"
                                    class="labor_price"
                                    value="{{number_format($labor_price, 2, ",", ".")}}"
                                    onkeydown="add2decimals(event)"
                                />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    
    <section class="section">
        <div class="table-container" id="table-container-plan">
            <div class="table-container-title">
                <h3>Planos</h3>
            </div>

            <table class="table-container-content">
                <thead>
                    <tr>
                        <th>Quant.</th>
                        <th>Planos</th>
                        <th>Valor Unitário</th>
                        <th>Valor total</th>
                    </tr>
                </thead>

                <tbody id="plan-row-body">
                    <tr class="plan-row" id="plan-row-0">
                        <td>
                            <div>
                                <input
                                    type="text"
                                    name="quantity_plan"
                                    class="quantity"
                                    value="{{ $plan->quantity }}"
                                />
                            </div>
                        </td>

                        <td>
                            <div>
                                <select name="plan" id="plan" class="plan" onchange="changePrice(this)">
                                    @foreach ($default_plans as $default_plan)
                                    <option value="{{$default_plan['id'] -1}}" {{ ($plan->plan) == ($default_plan['id'] - 1) ? 'selected' : '' }}>{{$default_plan['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>

                        <td>
                            <div>
                                @foreach ($default_plans as $default_plan)
                                <span
                                    name="{{ ($plan->plan) == ($default_plan['id'] - 1) ? 'unitary_price_plan' : '' }}"
                                    class="unitary_price plan_unitary_price_{{$default_plan['id']}} plan_unitary_price"
                                    style="display: {{ ($plan->plan) == ($default_plan['id'] - 1) ? 'inline-block' : 'none' }};"
                                >
                                    {{number_format($default_plan['unitary_price'], 2, ",", ".")}}
                                </span>
                                @endforeach
                            </div>
                        </td>

                        <td>
                            <div>
                                <span
                                    name="plan_total_price"
                                    id="plan_total_price"
                                    class="plan_total_price" 
                                >
                                {{number_format($plan->plan_total_price, 2, ",", ".")}}
                                </span>
                            </div>
                        </td>
                      
                    </tr>
                </tbody>
            </table>

            <div class="full-price">
                <h4>Total</h4>
                <p>R$ {{number_format($players_full_price, 2, ",", ".")}}</p>
            </div>
        </div>
    </section>

    <div class="total-price">
        <h4>Valor Total</h4>
        <p>R$ {{number_format($total_price, 2, ",", ".")}}</p>
    </div>

    <div class="submit-form-button-container">
        <button type="submit" class="submit-form">Salvar Dados</button>
    </div>
</form>
@endauth
@guest
<div class="div-error">
    <p>Por favor, registre-se ou faça o login para acessar as tabelas!</p>
</div>
@endguest

@endsection
