@extends('errors::minimal')

@section('title', __('Trop de Requêtes'))
@section('code', '429')
@section('message', __('Vous avez envoyé trop de requêtes dans un délai donné. Veuillez réessayer plus tard.'))

