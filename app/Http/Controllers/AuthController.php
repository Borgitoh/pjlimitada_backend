<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // REGISTRO
    public function register(Request $request)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'nif'      => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'senha'    => 'required|string|min:6',
            'telefone' => 'nullable|string|max:20',
            'role'     => 'in:cliente,gestor,admin,master,vendedor',
            'activo'   => 'boolean'
        ]);

        $user = User::create([
            'nome'     => $request->nome,
            'nif'      => $request->nif,
            'email'    => $request->email,
            'senha'    => Hash::make($request->senha),
            'telefone' => $request->telefone,
            'role'     => $request->role ?? 'cliente',
            'activo'   => $request->activo ?? true,
        ]);

        return response()->json([
            'user' => $user,
            'message' => 'Usuário registrado com sucesso!',
        ], 201);
    }

    // LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'senha' => 'required|string',
        ]);

        $user = User::where('email', $request->login)
            ->orWhere('telefone', $request->login)
            ->first();

        if (! $user || ! Hash::check($request->senha, $user->senha)) {
            throw ValidationException::withMessages([
                'login' => ['Credenciais inválidas.'],
            ]);
        }

        if (! $user->activo) {
            throw ValidationException::withMessages([
                'login' => ['Conta desativada.'],
            ]);
        }

        $token = $user->createToken('token')->plainTextToken;

        $user->last_login = now();
        $user->save();

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout efetuado com sucesso.'
        ]);
    }

    // FORGOT PASSWORD
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Link enviado para o email.'])
            : response()->json(['message' => 'Erro ao enviar link.'], 500);
    }

    // RESET PASSWORD
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'senha', 'senha_confirmation'),
            function ($user, $password) {
                $user->forceFill([
                    'senha' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Senha redefinida com sucesso.'])
            : response()->json(['message' => 'Erro ao redefinir senha.'], 500);
    }

    // CHANGE PASSWORD
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:6|confirmed',
        ]);

        $user = $request->user();

        if (! Hash::check($request->current_password, $user->senha)) {
            return response()->json([
                'message' => 'Senha atual incorreta.'
            ], 400);
        }

        $user->update([
            'senha' => Hash::make($request->new_password),
        ]);

        return response()->json([
            'message' => 'Senha alterada com sucesso.',
            'user' => $user
        ]);
    }

    // LIST USERS
    public function listUsersAllowed()
    {
        $allowedRoles = ['gestor', 'admin', 'vendedor'];

        $users = User::whereIn('role', $allowedRoles)
            ->orderBy('nome', 'asc')
            ->get();

        return response()->json([
            'message' => 'Lista de usuários carregada com sucesso.',
            'users'   => $users
        ]);
    }

    // UPDATE USER
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'nome'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'telefone' => 'sometimes|string|max:20',
            'role'     => 'sometimes|in:cliente,gestor,admin,master,vendedor',
            'activo'   => 'sometimes|boolean',
            'senha'    => 'sometimes|string|min:6',
        ]);

        $user = User::find($id);

        if (! $user) {
            return response()->json([
                'message' => 'Usuário não encontrado.'
            ], 404);
        }

        if ($request->has('nome')) $user->nome = $request->nome;
        if ($request->has('email')) $user->email = $request->email;
        if ($request->has('telefone')) $user->telefone = $request->telefone;
        if ($request->has('role')) $user->role = $request->role;
        if ($request->has('activo')) $user->activo = $request->activo;

        if ($request->has('senha') && !empty($request->senha)) {
            $user->senha = Hash::make($request->senha);
        }

        $user->save();

        return response()->json([
            'message' => 'Usuário atualizado com sucesso.',
            'user' => $user
        ]);
    }
}