## Skill: lethal trifecta
Raise a CRITICAL only when ALL THREE are present in one flow, each with a file:line:
(1) UNTRUSTED content reaches an LLM/agent, (2) that agent can read PRIVATE data,
(3) it has an EXFILTRATION path (outbound call / attacker-readable output). A plain
authenticated `request → DB read → JSON response` is NOT a trifecta — do not classify
it as one. When unsure, report as an ordinary access-control finding instead.