## Skill: PR quality rubric
Hold every change to this bar and call out where it falls short:
- **Correctness** — the change does what it claims and handles the unhappy paths.
- **Tests** — new behaviour is covered by a test that would fail if it regressed.
- **Docs** — public behaviour changes are reflected in comments/docs.
- **Clarity** — names and control flow read cleanly; no needless complexity.
Only raise a finding when a dimension is concretely missing — never a generic nit.