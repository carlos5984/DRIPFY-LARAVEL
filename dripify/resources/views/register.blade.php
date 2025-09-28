<x-layout>
    <form method="post" action="">
        @csrf
        <input type="text" name="name" placeholder="name">
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <button type="submit">Register</button>
    </form>
</x-layout>
