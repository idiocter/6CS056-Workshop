#!/bin/sh

set -eu

root_dir=$(CDPATH= cd -- "$(dirname -- "$0")" && pwd)

usage() {
    printf '%s\n' "Usage: ./laravel-create.sh PROJECT-NAME [--blade|--vite|--react|--vue|--svelte|--livewire]"
    printf '%s\n' "PROJECT-NAME must start with Workshop or Tutorial."
}

project_name="${1:-}"
stack="${2:-}"

if [ -z "$project_name" ]; then
    usage
    exit 1
fi

case "$project_name" in
    *[!A-Za-z0-9_-]*|'')
        printf '%s\n' "Project names may contain only letters, numbers, hyphens, and underscores."
        exit 1
        ;;
esac

case "$project_name" in
    [Ww]orkshop*) collection_dir="$root_dir/Workshops" ;;
    [Tt]utorial*) collection_dir="$root_dir/Tutorials" ;;
    *)
        printf '%s\n' "Project names must start with Workshop or Tutorial."
        exit 1
        ;;
esac

project_dir="$collection_dir/$project_name"

if [ -e "$project_dir" ]; then
    printf '%s\n' "The destination already exists: $project_dir"
    exit 1
fi

if [ -z "$stack" ]; then
    printf '%s\n' \
        "Choose a Laravel frontend:" \
        "  1) Blade only" \
        "  2) Vite" \
        "  3) React with Vite" \
        "  4) Vue with Vite" \
        "  5) Svelte with Vite" \
        "  6) Livewire"
    printf 'Selection [1]: '
    read -r selection

    case "${selection:-1}" in
        1) stack="--blade" ;;
        2) stack="--vite" ;;
        3) stack="--react" ;;
        4) stack="--vue" ;;
        5) stack="--svelte" ;;
        6) stack="--livewire" ;;
        *)
            printf '%s\n' "Invalid selection."
            exit 1
            ;;
    esac
fi

case "$stack" in
    --blade|blade)
        package="laravel/laravel"
        stability="stable"
        frontend_mode="blade"
        ;;
    --vite|vite)
        package="laravel/laravel"
        stability="stable"
        frontend_mode="vite"
        ;;
    --react|react)
        package="laravel/react-starter-kit"
        stability="dev"
        frontend_mode="react"
        ;;
    --vue|vue)
        package="laravel/vue-starter-kit"
        stability="dev"
        frontend_mode="vue"
        ;;
    --svelte|svelte)
        package="laravel/svelte-starter-kit"
        stability="dev"
        frontend_mode="svelte"
        ;;
    --livewire|livewire)
        package="laravel/livewire-starter-kit"
        stability="dev"
        frontend_mode="livewire"
        ;;
    *)
        usage
        exit 1
        ;;
esac

if ! command -v php >/dev/null 2>&1; then
    printf '%s\n' "PHP is not available in PATH. Open a new terminal and try again."
    exit 1
fi

if ! command -v composer >/dev/null 2>&1; then
    printf '%s\n' "Composer is not available in PATH. Open a new terminal and try again."
    exit 1
fi

mkdir -p "$collection_dir"

printf '%s\n' "Creating $project_name in $collection_dir from $package..."

set -- create-project "$package" "$project_dir"

if [ "$stability" = "dev" ]; then
    set -- "$@" --stability=dev
fi

composer "$@"

printf '%s\n' "$frontend_mode" > "$project_dir/.laravel-frontend"

printf '\nCreated %s\n' "$project_dir"
printf 'Frontend mode: %s\n' "$frontend_mode"
printf 'Start it: cd %s && php artisan serve\n' "$project_dir"
