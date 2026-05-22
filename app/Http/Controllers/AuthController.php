<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Registro de usuário
    public function register(Request $request)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'nif'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'senha' => 'required|string|min:6',
            'telfoene'    => 'nullable|string|max:20',
            'role'     => 'in:cliente,gestor,admin,master,vendedor',
            'activo'   => 'boolean'
        ]);

        $user = User::create([
            'nome'     => $request->nome,
            'nif'     => $request->nif,
            'email'    => $request->email,
            'password' => Hash::make($request->senha),
            'telfoene'    => $request->telfoene,
            'role'     => $request->role ?? 'cliente',
            'activo'   =>  $request->activo,
        ]);

        return response()->json([
            'user' => $user,
            'message' => 'Usuário registrado com sucesso!',
        ], 201);
    }

    // Login do usuário
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'senha' => 'required|string',
        ]);

        $user = User::where('email', $request->login)
            ->orWhere('telfoene', $request->login)
            ->first();

        if (! $user || ! Hash::check($request->senha, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }
        
        if (! $user->activo) {
            throw ValidationException::withMessages([
                'email' => ['A sua conta está desativada. Contacte o administrador.'],
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

    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout efetuado com sucesso.']);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Link de redefinição enviado para seu e-mail.'])
            : response()->json(['message' => 'Erro ao enviar o link.'], 500);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'senha' => 'required|string|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'senha', 'senha_confirmation',),
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

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:6|confirmed',
        ]);

        $user = $request->user();

        if (! Hash::check($request->current_password, $user->senha)) {
            return response()->json(['message' => 'Senha atual incorreta.'], 400);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json(['message' => 'Senha alterada com sucesso.',  $user]);
    }

    public function listUsersAllowed()
    {
        // Lista apenas os roles permitidos
        $allowedRoles = ['gestor', 'admin', 'vendedor'];

        $users = User::whereIn('role', $allowedRoles)
            ->orderBy('name', 'asc')
            ->get();

        return response()->json([
            'message' => 'Lista de usuários carregada com sucesso.',
            'users'   => $users
        ], 200);
    }

    public function updateUser(Request $request, $id)
    {
        // Validar o request
        $request->validate([
            'nome'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'telefone'    => 'sometimes|string|max:20',
            'role'     => 'sometimes|in:cliente,gestor,admin,master,vendedor',
            'activo'   => 'sometimes|boolean',
            'senha' => 'sometimes|string|min:6',
        ]);

        // Buscar o usuário
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuário não encontrado.'
            ], 404);
        }

        // Atualizar os dados
        if ($request->has('nome')) {
            $user->nome = $request->nome;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('telefone')) {
            $user->telefone = $request->telefone;
        }

        if ($request->has('role')) {
            $user->role = $request->role;
        }

        if ($request->has('activo')) {
            $user->activo = $request->activo;
        }

        if ($request->has('senha') && !empty($request->senha)) {
            $user->senha = Hash::make($request->senha);
        }

        $user->save();

        return response()->json([
            'message' => 'Usuário atualizado com sucesso.',
            'user'    => $user
        ], 200);
    }
}
