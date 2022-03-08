<?php 
require_once "header.php";
?>

<section>
    <h1>Ajouter un logement</h1>
    <hr>
    <form style="display: flex; justify-content:center;">
        <div style="width: 80%; border: solid 1px black; padding: 2%;">
            <div class="row">
                <div class="col">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="img">Images</label>
                    <input type="text" class="form-control" id="img" name="img">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="home_type">Logement</label>
                    <select class="form-control" id="home_type" name="home_type" >
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
                <div class="col">
                    <label for="room_type">Type de logement</label>
                    <select class="form-control" id="room_type" name="room_type" >
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="capacity">Voyageurs</label>
                    <input type="text" class="form-control" id="capacity" name="capacity">
                </div>
                <div class="col">
                    <label for="nb_bedroom">Chambres</label>
                    <input type="text" class="form-control" id="nb_bedroom" name="nb_bedroom">
                </div>
                <div class="col">
                    <label for="nb_bathroom">Salles de bain</label>
                    <input type="text" class="form-control" id="nb_bathroom" name="nb_bathroom">
                </div>
            </div>
            <div class="row">
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_tv" name="has_tv">
                    <label class="form-check-label" for="has_tv"> TV </label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_wifi" name="has_wifi">
                    <label class="form-check-label" for="has_wifi"> Wifi </label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_kitchen" name="has_kitchen">
                    <label class="form-check-label" for="has_kitchen">Cuisine</label>
                </div>
                <div class="col form-check">
                    <input class="form-check-input" type="checkbox" id="has_aircon" name="has_aircon">
                    <label class="form-check-label" for="has_aircon">Climatisation</label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <label for="adress">Adresse</label>
                    <input type="text" class="form-control" id="adress" name="adress">
                </div>
                <div class="col-sm-4">
                    <label for="city">Ville</label>
                    <input type="text" class="form-control" id="city" name="city">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="start_dispo">Première disponibilité</label><br>
                    <input type="date" id="start_dispo">
                </div>
                <div class="col">
                    <label for="end_dispo">Dernière disponibilité</label><br>
                    <input type="date" id="end_dispo">
                </div>
                <div class="col">
                    <label for="price">Prix/nuit</label>
                    <input type="text" class="form-control" id="price" name="price">
                </div>
            </div>
            <button type="submit">+ Ajouter</button>
        </div>
    </form>

<style>body {background-color: lightgrey;}</style>
